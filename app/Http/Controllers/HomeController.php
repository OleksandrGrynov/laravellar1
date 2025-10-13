<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', ['title' => 'Головна']);
    }

    public function about()
    {
        return view('pages.about', ['title' => 'Про сайт']);
    }
}
