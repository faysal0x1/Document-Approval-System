<?php

namespace App\Http\Controllers;

class DashboardRedirectController extends Controller
{
    public function index()
    {

        $role = getUserRoleName();

        return redirect()->route($role.'dashboard');
    }
}
