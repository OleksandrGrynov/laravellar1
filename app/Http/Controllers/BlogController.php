<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View { return view('blog.index'); }
    public function about(): View { return view('blog.about'); }
    public function show(string $slug): View { return view('blog.show', compact('slug')); }
}
