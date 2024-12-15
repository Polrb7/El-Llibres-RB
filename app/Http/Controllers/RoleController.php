<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('users.dashboard');
    }
}
