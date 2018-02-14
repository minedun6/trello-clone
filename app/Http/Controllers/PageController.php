<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function uploads()
    {
        return view('uploads');
    }

    public function upload(Request $request)
    {
        return $request->all();
    }
}
