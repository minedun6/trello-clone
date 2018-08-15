<?php namespace App\Http\Controllers\Symmetryk\Pages;


use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function login()
    {
        return view('symmetryk.pages.login');
    }

    public function home()
    {
        return view('symmetryk.pages.home');
    }

}