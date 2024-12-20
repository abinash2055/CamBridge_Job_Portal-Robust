<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorJobApplicationController extends Controller
{
    public function index()
    {
        $applicationsWithPostAndUser = collect();
        $company = auth()->user()->company;

        if ($company) {
            $ids =  $company->posts()->pluck('id');
            $applications = JobApplication::whereIn('post_id', $ids);
            $applicationsWithPostAndUser = $applications->with('user', 'post')->latest()->paginate(10);
        }

        return view('author.job.index')->with([
            'applications' => $applicationsWithPostAndUser,
        ]);
    }

    public function show($id)
    {
        // Try to find the application by ID
        $application = JobApplication::find($id);

        // If no application is found, redirect or return an error
        if (!$application) {

            Alert::toast('Job application not found.', 'error');

            return redirect()->back();
        }

        // Get the related post, if exists
        $post = $application->post()->first();
        if (!$post) {

            Alert::toast('Post related to this application not found.', 'error');

            return redirect()->back();
        }

        // Get the applicant (user) by user_id
        $applicant = User::find($application->user_id);
        if (!$applicant) {

            Alert::toast('Applicant not found.', 'error');

            return redirect()->back();
        }

        // Get the company related to the post, if exists
        $company = optional($post)->company()->first(); // Use optional in case $post or company is null

        // Return the view with the data
        return view('author.job.show')->with([
            'applicant' => $applicant,
            'post' => $post,
            'company' => $company,
            'application' => $application
        ]);
    }

    public function destroy(Request $request)
    {
        $application = JobApplication::find($request->application_id);
        $application->delete();

        Alert::toast('Company deleted', 'warning');

        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function pending()
    {
        $pendingApplications = JobApplication::where('status', 'pending')->get();

        return view('author.job.pendingApplication', compact('pendingApplications'));
    }

    // ShortListed Application
    public function showShortListed()
    {
        $shortlistedApplications = JobApplication::where('status', 'shortlisted')->get();

        return view('author.job.shortListedApplication', compact('shortlistedApplications'));
    }

    // Rejected Application
    public function rejected()
    {
        $rejectedApplications = JobApplication::where('status', 'rejected')->get();

        return view('author.job.rejectApplication', compact('rejectedApplications'));
    }

    // For reject button in index page
    public function reject($id)
    {
        $application = JobApplication::findOrFail($id);

        $application->status = 'rejected';
        $application->save();

        return redirect()->route('author.jobApplication.index');

        Alert::toast('Application rejected successfully.', 'success');
    }

    public function jobList()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the active jobs where the company_id matches the user's company_id
        $activeJobs = Post::with('company')->whereHas('company', function ($query) use ($user) {
            $query->where('user_id', $user->id); // Ensure the job's company_id matches the user's user_id
        })
            ->oldest() // Order by oldest
            ->paginate(10);

        // Get dashboard count data (assuming this is defined in the controller)
        $dashCount = $this->getDashCount();

        // Get all job categories (this may or may not be needed based on your view)
        $jobCategories = CompanyCategory::all();

        return view('author.job.view-all-jobs')->with([
            'activeJobs' => $activeJobs,
            'dashCount' => $dashCount,
            'jobCategories' => $jobCategories,
        ]);
    }

    public function saveStatus(Request $request)
    {
        $applicationId = $request->input('application_id');
        $status = $request->input('status');

        // Find the job application and update the status
        $application = JobApplication::find($applicationId);
        if ($application) {
            $application->status = $status;
            $application->save();

            Alert::toast('Status updated successfully.', 'success');

            return redirect()->route('author.jobApplication.index');
        }

        Alert::toast('Applicant not found.', 'warning');

        return redirect()->route('author.jobApplication.index');
    }

    // Job Application List
    public function job()
    {
        $applications = JobApplication::with(['user', 'post'])->get();

        return view('author.job.index', compact('applications'));
    }

    // For Complete Job Details
    protected function getDashCount()
    {
        return [
            'totalJobs' => Post::count(),
            'activeJobs' => Post::where('status', 'active')->count(),
            'inactiveJobs' => Post::where('status', 'inactive')->count(),
            'livePost' => Post::where('deadline', '>', Carbon::now())->count(),
            'authors' => User::role('author')->count(),
        ];
    }
}
