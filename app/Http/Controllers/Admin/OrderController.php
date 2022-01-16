<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\Order;
use App\Repositories\Entities\ProductEdition;
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

    public function action(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        switch ($request->status) {
            case '2':
                ProductEdition::where('id', $order->product_edition_id)->update([
                    'is_sold' => 1
                ]);
                
                $order->update([
                    'status' => 2
                ]);
                break;
            
            default:
                $order->update([
                    'status' => 0
                ]);
                break;
        }

        notice('success', 'Success');

        return redirect()->route('admin.order.index');

    }

    public function delete(Request $request, $orderId)
    {
        $order = Order::find($orderId)->delete();
        notice('success', 'Success. Deleted');

        return redirect()->route('admin.order.index');

    }

}
