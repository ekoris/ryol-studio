<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use File;

class OrderController extends Controller
{
    public function __construct(OrderRepository $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $orders = $this->product->fetch($request->all(), true);

        return view('admin.order.index', compact('orders'));
    }

}
