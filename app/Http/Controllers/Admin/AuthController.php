<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function index()
    {
        if(logged_in_user()){
            return redirect()->route('admin.index');
        }

        return view('admin.login');
    }

    public function signIn(Request $request)
    {
        $data = request()->except(['_token']);

        $credentials = $data;

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back();
        }
    }

    public function signOut(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.index');
    }

}
