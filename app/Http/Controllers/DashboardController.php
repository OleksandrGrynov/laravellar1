<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View { return view('dashboard.index'); }
    public function stats(): View { return view('dashboard.stats'); }
    public function settings(): View { return view('dashboard.settings'); }
}
