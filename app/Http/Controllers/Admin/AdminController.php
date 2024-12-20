<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// For Admin Dashboard
class AdminController extends Controller
{
    public function dashboard()
    {
        $authors = User::role('author')->with('company')->oldest()->paginate(10);
        $roles = Role::all()->pluck('name');
        $permissions = Permission::all()->pluck('name');
        $rolesHavePermissions = Role::with('permissions')->get();

        $dashCount = [];
        $dashCount['author'] = User::role('author')->count();
        $dashCount['user'] = User::role('user')->count();
        $dashCount['post'] = Post::count();
        $dashCount['livePost'] = Post::where('status', 'active')->where('deadline', '>', Carbon::now())->count();

        return view('admin.dashboard')->with([
            'companyCategories' => CompanyCategory::all(),
            'dashCount' => $dashCount,
            'recentAuthors' => $authors,
            'roles' => $roles,
            'permissions' => $permissions,
            'rolesHavePermissions' => $rolesHavePermissions,
        ]);
    }

    // For All Users
    public function viewAllUsers()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->oldest()->paginate(10);

        return view('admin.user.view-all-users')->with([
            'users' => $users
        ]);
    }

    // For Deletion of User
    public function destroyUser(Request $request)
    {
        // need to delete company and post also
        $user = User::findOrFail($request->user_id);

        if ($user->delete()) {

            Alert::toast('Deleted Successfully!', 'danger');

            return redirect()->route('admin.user.viewAllUsers');
        } else {

            return redirect()->route('admin.user.viewAllUsers');
        }
    }

    // For Deletion of User
    public function destroyApplication(Request $request)
    {
        // need to delete company and post also
        $post = User::findOrFail($request->user_id);

        if ($post->delete()) {

            Alert::toast('Deleted Successfully!', 'danger');

            return redirect()->route('admin.post.viewAllApplications');
        } else {

            return redirect()->route('admin.post.viewAllApplication');
        }
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
