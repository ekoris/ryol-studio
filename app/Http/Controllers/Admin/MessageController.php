<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\ContactUs;
use App\Repositories\Entities\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = ContactUs::paginate(20);

        return view('admin.message', compact('messages'));
    }
}
