<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $title = 'Admin Dashboard';
        return view('dashboard.index', compact('title'));
    }
}
