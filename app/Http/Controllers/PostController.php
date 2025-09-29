<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['title'=>'Laravel 11','excerpt'=>'Reverb, новинки','author'=>'Admin','date'=>now()],
            ['title'=>'Blade Components','excerpt'=>'Компоненти','author'=>'Editor','date'=>now()->subDays(2)],
            ['title'=>'Vite','excerpt'=>'Збірка, HMR','author'=>'Admin','date'=>now()->subWeek()],
        ];

        return view('posts.index', [
            'title' => 'Список постів',
            'posts' => $posts
        ]);
    }
}
