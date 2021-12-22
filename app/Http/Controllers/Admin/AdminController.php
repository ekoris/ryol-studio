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
        $output_file = 'uploads/qr-code/'.time().'.png';
        $image = \QrCode::format('png')
                 ->size(100)->errorCorrection('H')
                 ->generate(route('detail-product', $product->slug));

        Storage::disk('public')->put($output_file, $image);                    

        return Storage::disk('public')->download($output_file);

    }
}
