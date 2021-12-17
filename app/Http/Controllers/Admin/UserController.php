<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users = $this->user->fetch($request->all(), 15);        

        return view('admin.user.index', compact('users'));
    }

    public function about(Request $request)
    {
        return view('admin.about');
    }

}
