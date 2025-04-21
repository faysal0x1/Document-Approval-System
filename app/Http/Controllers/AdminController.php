<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }
}
