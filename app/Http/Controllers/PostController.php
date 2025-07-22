<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function publicIndex()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(10);
        return view('posts.public_index', compact('posts'));
    }

    public function index()
    {        
        $posts = User::postsByAuth()->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        User::postsByAuth()->create($request->validated());
        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorizePost($post);

        $data = $request->validated();
        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $this->authorizePost($post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(403);
        }
        return view('posts.show', compact('post'));
    }

    private function authorizePost(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
    }

}
