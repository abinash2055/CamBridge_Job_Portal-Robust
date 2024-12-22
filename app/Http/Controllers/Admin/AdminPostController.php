<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Company;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {   
        $companies = Company::orderBy('title', 'asc')->get(['id', 'title']);
        
        // Check if company_id is selected
        if ($request->has('company_id') && !empty($request->input('company_id'))) {
            $company_id = $request->input('company_id');
            $posts = Post::where('company_id', $company_id)->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }

        return view('admin.post.view-all-applications', compact('posts', 'companies'));
    }

    public function toggleStatus(Request $request)
    {
        $post = Post::find($request->id);

        if ($post) {
            $post->status = $request->status === 'active' ? 'deactivate' : 'active';
            $post->save();

            return response()->json(['success' => true, 'status' => $post->status]);
        }

        return response()->json(['success' => false, 'message' => 'Post not found'], 404);
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Alert::toast('Post deleted successfully!', 'success');

        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
