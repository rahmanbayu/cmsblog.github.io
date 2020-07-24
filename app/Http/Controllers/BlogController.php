<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('welcome', ['posts' => Post::search()->simplePaginate(6), 'categories' => Category::get(), 'tags' => Tag::get()]);
    }

    public function category(Category $category)
    {
        return view('blogs.category', ['category' => $category, 'posts' => $category->posts()->search()->simplePaginate(6), 'categories' => Category::get(), 'tags' => Tag::get()]);
    }

    public function tag(Tag $tag)
    {
        return view('blogs.tag', ['tag' => $tag, 'posts' => $tag->posts()->search()->simplePaginate(6), 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    public function show(Post $post)
    {
        return view('blogs.show', ['post' => $post]);
    }
}
