<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function overview()
    {
        return view('account.overview');
    }

    public function becomeEmployerView()
    {
        return view('account.becomeEmployer.become-employer');
    }

    public function becomeEmployer()
    {
        $user = User::find(auth()->user()->id);
        $user->removeRole('user');
        $user->assignRole('author');
        $user->role = "author";
        $user->save();

        return redirect()->route('author.authorSection');
    }

    public function applyJobView(Request $request)
    {
        if ($this->hasApplied(auth()->user(), $request->post_id)) {

            Alert::toast('You have already applied for this job!', 'success');

            return redirect()->route('post.show', ['job' => $request->post_id]);
        } else if (!auth()->user()->hasRole('user')) {

            Alert::toast('You are a employer! You can\'t apply for the job! ', 'error');

            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $post = Post::find($request->post_id);
        $company = $post->company()->first();

        return view('account.applyJob.apply', compact('post', 'company'));
    }


    public function applyJob(Request $request)
    {
        $application = new JobApplication;
        $user = User::find(auth()->user()->id);

        if ($this->hasApplied($user, $request->post_id)) {

            Alert::toast('You have already applied for this job!', 'success');

            return redirect()->route('post.show', ['job' => $request->post_id]);
        }

        $application->user_id = auth()->user()->id;
        $application->post_id = $request->post_id;
        $application->save();

        Alert::toast('Thank you for applying! Wait for the company to respond!', 'success');

        return redirect()->route('account.appliedJob');
    }

    public function changePasswordView()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {

            Alert::toast('Not authenticated!', 'success');

            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = auth()->user();
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (Hash::check($currentP, $authUser->password)) {

            if (Str::of($newP)->exactly($confirmP)) {

                $user = User::find($authUser->id);
                $user->password = Hash::make($newP);

                if ($user->save()) {

                    Alert::toast('Password Changed!', 'success');

                    return redirect()->route('account.overview');
                } else {
                    Alert::toast('Something went wrong!', 'warning');
                }
            } else {
                Alert::toast('Passwords do not match!', 'info');
            }
        } else {
            Alert::toast('Incorrect Password!', 'info');
        }

        return redirect()->back();
    }

    public function deactivateView()
    {
        return view('account.deactivate');
    }

    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);

        Auth::logout($user->id);

        if ($user->delete()) {

            Alert::toast('Your account was deleted successfully!', 'info');

            return redirect(route('home.index'));
        } else {
            return view('account.deactivate');
        }
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('login');
    }

    protected function hasApplied($user, $postId)
    {
        $applied = $user->applied()->where('post_id', $postId)->get();

        if ($applied->count()) {
            return true;
        } else {
            return false;
        }
    }

    public function appliedJob()
    {
        $applications = JobApplication::with(['post', 'post.company'])->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('account.applyJob.index', compact('applications'));
    }

    public function removeApplication($id)
    {
        $application = JobApplication::find($id);

        // Check if the application exists and belongs to the authenticated user
        if ($application && $application->user_id == auth()->id()) {

            // Check if the application is less than 24 hours old
            if ($application->created_at >= now()->subDay()) {
                $application->delete();

                Alert::toast('Your application has been removed successfully!', 'success');
            } else {
                Alert::toast('You can only remove applications within 24 hours of applying.', 'error');
            }
        } else {
            Alert::toast('Application not found or you do not have permission to remove it.', 'warning');
        }
        return redirect()->route('account.appliedJob');
    }

    public function updateAccountDetails(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'date_of_birth' => 'required|date',
            'location' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'current_job' => 'required|string|max:255',
        ]);

        // Find the authenticated user
        $user = User::find(auth()->user()->id);

        // Update the user's details
        $user->date_of_birth = $request->date_of_birth;
        $user->location = $request->location;
        $user->education = $request->education;
        $user->current_job = $request->current_job;

        // Save the changes
        if ($user->save()) {
            Alert::toast('Your account details have been updated!', 'success');
        } else {
            Alert::toast('There was an error updating your details.', 'error');
        }

        return redirect()->route('account.overview');
    }
}
