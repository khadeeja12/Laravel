<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //
    public function viewLogin()
    {
        return view('admins.login');
    }
}
