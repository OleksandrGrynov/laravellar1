<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        return view('lab.index');
    }

    public function about()
    {
        return view('lab.about');
    }

    public function status()
    {
        return view('lab.status', ['status' => 'OK']);
    }

    public function echo(Request $request)
    {
        return response()->json([
            'query' => $request->all(),
            'message' => 'Echo response'
        ]);
    }
}
