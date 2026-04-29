<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTallerController extends Controller
{
    public function index()
    {
        return view('admin.Admin_Dashboard');
    }
}
