<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostController extends Controller
{
    public function index()
    {
        // $posts = Post::where('status', 'active')->paginate(10);

        $posts = Post::paginate(10);

        return view('admin.post.view-all-applications', compact('posts'));
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
