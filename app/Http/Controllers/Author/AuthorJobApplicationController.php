<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusShortlisted;
use App\Mail\ApplicationStatusRejected;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Company;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class AuthorJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the current user's company
        $company = auth()->user()->company;
        $jobPosts = Post::where('company_id', $company->id)->with('company', 'company.user')->orderBy('id', 'desc')->get();
        
        // Fetch job posts associated with the company
        $applicationsWithPostAndUser = collect();

        // Check if a job ID is provided in the request
        if(isset($_GET['job_id']) && !empty($_GET['job_id']))
        {
            $job_id = $request->input('job_id');

            // Fetch all applications for the selected job post
            $applicationsWithPostAndUser = JobApplication::where('post_id', $job_id)->orderBy('id', 'desc')->paginate(10);
        }
        // Return the view with the all applications and job posts
        return view('author.job.index')->with([
            'applications' => $applicationsWithPostAndUser,
            'posts' => $jobPosts,  
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
        $company = optional($post)->company()->first(); 

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

    public function pending(Request $request)
    {
        $company = auth()->user()->company;
        $jobPosts = Post::where('company_id', $company->id)->with('company', 'company.user')->orderBy('id', 'desc')->get();
        
        $pendingApplications = collect();

        if(isset($_GET['job_id']) && !empty($_GET['job_id']))
        {
            $job_id = $request->input('job_id');
            $pendingApplications = JobApplication::where('post_id', $job_id)->orderBy('id', 'desc')->where('status', 'pending')->paginate(10);
        }

        return view('author.job.pendingApplication')->with(['applications' => $pendingApplications, 'posts' => $jobPosts,
    ]);
    }

    // ShortListed Application
    public function showShortListed(Request $request)
    {
    $company = auth()->user()->company;
    $jobPosts = Post::where('company_id', $company->id)->with('company', 'company.user')->orderBy('id', 'desc')->get();

    $shortlistedApplications = collect();

    if (isset($_GET['job_id']) && !empty($_GET['job_id'])) {
        $job_id = $request->input('job_id');

        $shortlistedApplications = JobApplication::where('post_id', $job_id)->where('status', 'shortlisted')->orderBy('id', 'desc')->paginate(10);
    }

    return view('author.job.shortListedApplication')->with(['applications' => $shortlistedApplications,'posts' => $jobPosts,
    ]);
}

    // Rejected Application
    public function rejected(Request $request)
    {
    $company = auth()->user()->company;
    $jobPosts = Post::where('company_id', $company->id)->with('company', 'company.user')->orderBy('id', 'desc')->get();

    $rejectedApplications = collect();

    if (isset($_GET['job_id']) && !empty($_GET['job_id'])) {
        $job_id = $request->input('job_id');
        $rejectedApplications = JobApplication::where('post_id', $job_id)->where('status', 'rejected')->orderBy('id', 'desc')->paginate(10);
    }

    return view('author.job.rejectApplication')->with(['applications' => $rejectedApplications, 'posts' => $jobPosts,
    ]);
}

    // For reject button in index page
    public function reject($id)
    {
        $application = JobApplication::findOrFail($id);

        $application->status = 'rejected';
        $application->save();
        $data = [
            'user' => $application->user->name,
            'userEmail' => $application->user->email,
            'application' => $application->status,
            'applicationDate' => $application->created_at,
            'jobPost' => $application->post->job_title,
        ];
        if ($application->status === 'rejected') {

            Mail::to($data['userEmail'])->send(new ApplicationStatusRejected($data));
        }

        return redirect()->route('author.jobApplication.index');

        Alert::toast('Application rejected successfully.', 'success');
    }

    public function jobList()
    {
        $user = auth()->user();

        $activeJobs = Post::with('company')->whereHas('company', function ($query) use ($user) {
            $query->where('user_id', $user->id); 
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

            $data = [
                'user' => $application->user->name,
                'userEmail' => $application->user->email,
                'application' => $application->status,
                'applicationDate' => $application->created_at,
                'jobPost' => $application->post->job_title,
            ];

            if ($status === 'shortlisted') {
                // Send verification email
                Mail::to($data['userEmail'])->send(new ApplicationStatusShortlisted($data));
                // dd('Email sent');
            } elseif ($status === 'rejected') {

                Mail::to($data['userEmail'])->send(new ApplicationStatusRejected($data));
                // dd('Email sent');
            }

            Alert::toast('Status updated and email successfully.', 'success');

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
