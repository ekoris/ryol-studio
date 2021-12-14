<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    public function index()
    {
        return view('admin.feed');
    }
}
