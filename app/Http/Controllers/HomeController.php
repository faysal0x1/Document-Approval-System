<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function home(): View
    {
        return view('website.index');
    }
}
