<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\CompanyCategory;
use RealRashid\SweetAlert\Facades\Alert;


class AdminAuthorController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $jobCount = Post::count();
        $authorCount = User::where('role', 'author')->count();
        $liveJobCount = Post::where('status', 'active')->count();
        $jobCategoriesCount = CompanyCategory::count();

        $authors = User::where('role', 'author')->get();

        return view('admin.author.index', compact('userCount', 'jobCount', 'authorCount', 'liveJobCount', 'jobCategoriesCount', 'authors'));
    }

    public function create()
    {
        return view('admin.author.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $author = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'author',
        ]);

        $author->assignRole('author');
        Alert::toast('Finally!! Author Created', 'info');

        return redirect()->route('admin.author.index');
    }

    public function edit($id)
    {
        $author = User::findOrFail($id);
        return view('admin.author.edit', ['author' => $author]);
    }

    public function update(Request $request, $id)
    {
        $author = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10',
        ]);

        $author->update([
            'name' => $request->name,
            'number' => $request->number,
        ]);

        Alert::toast('Finally!! Author Updated', 'info');
        return redirect()->route('admin.author.index');
    }

    public function destroy($id)
    {
        User::destroy($id);

        Alert::toast('Author Soft Deleted Successfully', 'success');

        // return redirect()->route('admin.author.index');
        return response()->json(['success' => 'Author soft deleted successfully.']);
    }

    // Handling Company by Admin
    public function manageCompany($id)
    {
        $author = User::findOrFail($id);

        if ($author->company) {
            return redirect()->route('admin.company.edit', ['id' => $author->id]);
        } else {
            Alert::toast('You must create a company first!', 'info');
            return redirect()->route('admin.company.create', ['id' => $author->id]);
        }
    }
}
