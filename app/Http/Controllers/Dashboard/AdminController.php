<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index(){
        $title = 'Admin Dashboard';
        $data = array(
            'wisata' => DB::table('tb_wisata')->count(),
            'info' => DB::table('tb_info')->count(),
            'kategori' => DB::table('tb_kategori')->count(),
            'armada' => DB::table('tb_mobil')->count(),
        );
        // dd($data['wisata']);
        return view('dashboard.index', compact('title', 'data'));
    }
}
