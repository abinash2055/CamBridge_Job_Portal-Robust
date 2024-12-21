<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Mail\ResetPasswordMail;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('auth.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'date_of_birth' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->location = $request->location;
        $user->education = $request->education;
        $user->current_job = $request->current_job;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Alert::toast('Profile updated successfully!', 'success');

        return redirect()->route('account.overview');
    }


    // To upload CV by user 
    public function uploadCvForm()
    {
        return view('account.uploadCv');
    }

    public function storeCv(Request $request)
    {
        $request->validate(
            [
                'cv' => 'required|mimes:pdf|max:3072',  // 3MB max size
            ],
            [
                'cv.required' => 'Please upload a CV.',
                'cv.mimes' => 'CV must be a PDF File Only.',
                'cv.max' => 'CV file must less than 2MB.'
            ]
        );

        // For current authenticated user only
        $user = Auth::user();

        if ($request->hasFile('cv')) {
            // for unique file name
            $fileNameToStore = $this->getFileName($request->file('cv'));

            // To store file
            $cvPath = $request->file('cv')->storeAs('public/cvs', $fileNameToStore);

            // To delete old CV
            if ($user->cv_path) {
                Storage::delete($user->cv_path);
            }

            // To update CV path
            $user->cv_path = 'storage/cvs/' . $fileNameToStore;
            $user->save();

            return redirect()->route('account.uploadCv');

            Alert::toast('CV uploaded successfully', 'success');
        }

        return redirect()->route('account.uploadCv');

        Alert::toast('Failed to upload CV. Please try again..', 'warning');
    }

    protected function getFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();

        return $actualFileName . time() . '.' . $fileExtension;
    }

    public function downloadCv($id)
    {
        $user = User::findOrFail($id);

        if (!$user->cv_path || !Storage::disk('local')->exists($user->cv_path)) {
            abort(404, 'CV not found.');
        }


        return Storage::disk('local')->download($user->cv_path);
    }
}
