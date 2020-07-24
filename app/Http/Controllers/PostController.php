<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['category'])->only('create', 'edit');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.form', ['categories' => Category::get(), 'tags' => Tag::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->all();
        $data['slug'] = \Str::slug($request->title);
        $data['image'] = $request->file('image')->store(
            'assets/posts',
            'public'
        );

        $post = Auth::user()->posts()->create($data);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }


        session()->flash('success', 'Create Post Success');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.form', ['post' => $post, 'categories' => Category::get(), 'tags' => Tag::get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([
            'title' => 'unique:posts,title,' . $post->id
        ]);
        $data = $request->all();
        $data['slug'] = \Str::slug($request->title);

        if ($request->image) {
            $post->imageDelete();
            $data['image'] = $request->file('image')->store(
                'assets/posts',
                'public'
            );
        }

        $post->tags()->sync($request->tags);

        $post->update($data);

        session()->flash('success', 'Edit posts success');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {

        $post = Post::withTrashed()->where('slug', $slug)->firstOrFail();


        if ($post->trashed()) {
            $post->imageDelete();
            $post->forceDelete();
            $post->tags()->detach();
            session()->flash('success', 'Delete post success');
        } else {
            $post->delete();
            session()->flash('success', 'Trashed post success');
        }

        return back();
    }

    public function trashed()
    {
        return view('posts.index', ['posts' => Post::onlyTrashed()->get()]);
    }
    public function restore($slug)
    {
        $post = Post::onlyTrashed()->where('slug', $slug)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Restore success');

        return redirect()->route('posts.trashed');
    }
}
