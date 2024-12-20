<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\District;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobApiController extends Controller
{

    //api route
    public function search(Request $request)
    {
        if ($request->q) {

            $posts = Post::where('job_title', 'LIKE', '%' . $request->q . '%');
        } elseif ($request->category_id) {

            $posts = Post::whereHas('company', function ($query) use ($request) {
                return $query->where('company_category_id', $request->category_id);
            });
        } elseif ($request->job_level) {
            $posts = Post::where('job_level', 'Like', '%' . $request->job_level . '%');
        } elseif ($request->district) {
            $posts = Post::where('district', 'Like', '%' . $request->district . '%');
        } elseif ($request->salary) {
            $posts = Post::where('salary', '<=',  $request->salary);
        } elseif ($request->education_level) {
            $posts = Post::where('education_level', 'Like', '%' . $request->education_level . '%');
        } elseif ($request->employment_type) {
            $posts = Post::where('employment_type', 'Like', '%' . $request->employment_type . '%');
        } else {
            $posts = Post::take(30);
        }

        $posts = $posts->has('company')->with('company')->paginate(6);

        return $posts->toJson();
    }
    public function getCategories()
    {
        $categories = CompanyCategory::all();

        return $categories->toJson();
    }

    public function getDistricts()
    {
        $districts = District::all();

        return $districts->toJson();
    }

    public function getAllOrganization()
    {
        $companies = Company::all();

        return $companies->toJson();
    }
    public function getAllByTitle()
    {
        $posts = Post::where('deadline', '>', Carbon::now())->get()->pluck('id', 'job_title');

        return $posts->toJson();
    }
}
