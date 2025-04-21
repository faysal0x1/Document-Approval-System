<?php

namespace App\Http\Controllers;

class UserRoleAssignmentController extends Controller
{
    public function index()
    {
        return view('admin.user-roles.index');
    }
}
