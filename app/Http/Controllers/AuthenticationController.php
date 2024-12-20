<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birth' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:users',
        ]);

        $token = Str::random(40);

        // Create the user a
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'location' => $request->location,
            'education' => $request->education,
            'current_job' => $request->current_job,
            'verification_code' => $token,
        ]);

        $user->assignRole('user');

        // Prepare email data
        $data = [
            'user' => $user->name,
            'verifyLink' => url('email/verify/' . $token),
        ];

        // Send verification email
        try {
            Mail::to($user->email)->send(new VerificationEmail($data));
        } catch (\Exception $e) {

            Alert::toast('Failed to send verification email. Please try again.', 'error');

            return redirect()->back();
        }

        Alert::toast('Registration successful! Please check your email for verification.', 'success');

        return redirect()->route('login')->with('success', 'Registration successfully! Please check your email for verification.');
    }

    public function forgotPassword(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {

            // Generate a random token for password reset
            $token = Str::random(60);
            $user->reset_token = $token; // Store the token in the user model
            $user->reset_token_expiry = now()->addHour(); // Set the expiry time for the token
            $user->save(); // Save the user model

            // Prepare email data
            $data = [
                'user' => $user->name,
                'resetLink' => url('reset-password/' . $token . '?email=' . urlencode($user->email)),
            ];

            // Send the password reset email with error handling
            try {
                Mail::to($user->email) // Replace with the admin's email address
                    ->send(new ResetPasswordMail($data));
            } catch (\Exception $e) {

                Alert::toast('Failed to send password reset email. Please try again.', 'error');

                return redirect()->back();
            }

            Alert::toast('Password reset link sent to your email!', 'success');

            return redirect()->route('login');
        }

        // If email is not found, return an error
        Alert::toast('Email not found.', 'error');

        return back()->with('error', 'Email not found.');
    }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyPasswordLink($token)
    {

        // Find the user by email
        $user = User::where('reset_token', $token)->first();

        if ($user && $user->reset_token_expiry > now()) {

            return view('auth.reset-password')
                ->with(['token' => $token, 'email' => $user->email]);;
        }

        // If email is not found, return an error
        Alert::toast('Password reset link expired!', 'error');

        return redirect()->route('login');
    }

    public function resetPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('reset_token', $request->token)->first();

        $user->forceFill([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expiry' => null
        ])->save();

        Alert::toast('Password reset successfully!', 'success');

        return redirect()->route('login');
    }

    public function verifyEmailLink($token)
    {

        // Find the user by email
        $user = User::where('verification_code', $token)->first();

        if ($user) {
            $user->forceFill([
                'verification_code' => null,
                'email_verified_At' => now()
            ])->save();

            // If email is found
            Alert::toast('Email verified successfully!', 'success');

            return redirect()->route('login');
        }

        // If email is not found, return an error
        Alert::toast('Email verification link expired!', 'error');

        return redirect()->route('login');
    }
}
