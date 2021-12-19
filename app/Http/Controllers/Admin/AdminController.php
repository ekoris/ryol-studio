<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\Product;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.up-comming.index');
    }

    public function qrcode($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return QrCode::size(200)->generate(route('detail-product', $product->slug));
    }
}
