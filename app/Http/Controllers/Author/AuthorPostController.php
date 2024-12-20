<?php

namespace App\Http\Controllers\Author;


use App\Http\Controllers\Controller;
use App\Events\PostViewEvent;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Post;
use App\Models\District;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorPostController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        // dd("Yes");
        if (!auth()->user()->company) {

            Alert::toast('You must create a company first!', 'info');

            return redirect()->route('author.company.create');
        }

        $districts = District::all();

        return view('author.post.create')->with('districts', $districts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|min:3',
            'vacancy_count' => 'required|numeric',
            'employment_type' => 'required',
            'job_location' => 'required',
            'salary' => 'required|numeric',
            'deadline' => 'required|date',
            'education_level' => 'required',
            'experience' => 'required',
            'job_district' => 'required|string',
            'skills' => 'required|array',
            'specifications' => 'nullable|string',
        ]);

        // Handle specifications, if not provided, use an empty string
        $specifications = $request->specifications ?? '';

        // dd($request->all());

        // Convert skills from Array to string separated by comma
        $skills = implode(',', $request->skills);

        // Create the new job post
        $post = Post::create([
            'company_id' => auth()->user()->company->id,
            'job_title' => $request->job_title,
            'job_level' => $request->job_level,
            'vacancy_count' => $request->vacancy_count,
            'employment_type' => $request->employment_type,
            'district' => $request->job_district,
            'job_location' => $request->job_location,
            'salary' => $request->salary,
            'deadline' => $request->deadline,
            'education_level' => $request->education_level,
            'experience' => $request->experience,
            'skills' => $skills,
            'specifications' => $specifications,
        ]);

        Alert::toast('Job created successfully!', 'success');

        // Redirect to view all applications
        return redirect()->route('author.viewAllJob', $post->id);
    }



    public function show($id)
    {
        $post = Post::with('company', 'company.user')->findOrFail($id);
        // dd($post->all());
        event(new PostViewEvent($post));

        $company = $post->company()->first();

        $similarPosts = Post::whereHas('company', function ($query) use ($company) {

            return $query->where('company_category_id', $company->company_category_id);
        })->where('id', '<>', $post->id)->with('company')->take(5)->get();

        // return redirect()->route('author.post.show', ['id' => $post->id]);
        return view('author.post.show', compact('post', 'company', 'similarPosts'));
    }

    public function edit(Post $post)
    {
        $companies = Company::all();

        return view('author.post.edit', compact('post', 'companies'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'company_id' => 'required|integer',
            'job_title' => 'required|string|max:255',
            'job_level' => 'required|string|max:255',
            'vacancy_count' => 'required|integer',
            'employment_type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'job_location' => 'required|string|max:255',
            'deadline' => 'required|date',
            'education_level' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'skills' => 'required|array',
            'skills.*' => 'string|max:255',
            'specifications' => 'nullable|string|max:500',

        ]);

        // Convert skills array to comma-separated string
        $data = $request->all();
        $data['skills'] = implode(',', $request->skills);
        $data['specifications'] = $request->specifications ?? '';


        // Update the post with all data except skills (handled above)
        $post->update($data);

        Alert::toast('Job post updated successfully!!', 'success');

        return redirect()->route('author.viewAllJob');
    }


    public function destroy(Post $post)
    {
        if ($post->delete()) {

            Alert::toast('Post successfully deleted!', 'success');

            return response()->json(['success' => 'Post deleted successfully.']);
        }
        // return redirect()->back();
        return response()->json(['error' => 'Failed to delete Post.'], 500);
    }

    protected function requestValidate($request)
    {
        return $request->validate([
            'job_title' => 'required|min:3',
            'job_level' => 'required',
            'vacancy_count' => 'required|int',
            'employment_type' => 'required',
            'job_location' => 'required',
            'salary' => 'required',
            'deadline' => 'required',
            'education_level' => 'required',
            'experience' => 'required',
            'skills' => 'required|array',
            'skills.*' => 'string|max:255',
            'specifications' => 'sometimes|min:5',
        ]);
    }

    public function viewAllJobs()
    {
        // Get the currently authenticated user's company ID
        $companyId = auth()->user()->company->id;

        // Fetch only the jobs associated with the current user's company
        $activeJobs = Post::with('company')->where('company_id', $companyId)->where('status', 'active')->paginate(10);

        // Dash count (for total, active, live posts by the author's company)
        $dashCount = [
            'activeJobs' => Post::where('company_id', $companyId)->where('status', 'active')->count(),
            'totalJobs' => Post::where('company_id', $companyId)->count(),
            'livePost' => Post::where('company_id', $companyId)->where('status', 'live')->count(),
        ];

        // To get job categories 
        $jobCategories = CompanyCategory::all();

        return view('author.view-all-jobs', compact('activeJobs', 'dashCount', 'jobCategories'));
    }
}
