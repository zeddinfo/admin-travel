<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class LoginController extends Controller
{
    public function index(){
        $title = 'Authentikasi Admin';
        return view('admin/auth', compact('title'));
    }

    public function auth(Request $request){
        // dd($request->all());
        if(Session::get('login')){
            return redirect('/admin');
        }

        if($request->isMethod('post')){
            $data = DB::select("
            select * from user where username = '$request->username'  limit 1
            ");

            if($data && $data[0]->password == md5($request->password)){
                Session::put('name', $data[0]->nama);
                Session::put('username', $data[0]->username);
                Session::put('login', TRUE);
                
                toastr()->success('Authentikasi Berhasil');
                return redirect('/admin');
            }
            // toastr()->danger('Username atau Password Salah');
            return redirect('/login')->with(['error' => 'Username atau Password Salah']);
        }
        // toastr()->danger('Username atau Password Salah');
        return view('admin.auth');
    }
}
