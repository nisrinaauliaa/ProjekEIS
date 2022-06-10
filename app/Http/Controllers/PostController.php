<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            "title" => "All Posts",
            "active" => "posts",
            "posts" => Post::latest()->get()
        ]);
    }
    public function postexport()
    {
        return Excel::download(new PostExport, 'PostReporting.xlsx');
    }

    public function show(Post $post)
    {
        return view('post',[
            "title" => "Single Post",
            "active" => 'posts',
            "post" => $post
        ]);
    }
}
