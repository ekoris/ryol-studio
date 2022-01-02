<?php

namespace App\Http\Controllers;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\ArtWorkRepository;
use App\Repositories\Entities\Order;
use App\Repositories\Entities\OrderShipping;
use App\Repositories\Entities\User;
use App\Repositories\Entities\WebsiteManagement;
use App\Repositories\ProductRepository;
use App\Repositories\UpCommingRepository;
use App\Repositories\WebsiteManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function __construct(ArtWorkRepository $artWork, WebsiteManagementRepository $website, UpCommingRepository $upComming, ProductRepository $product)
    {
        $this->artWork = $artWork;
        $this->upComming = $upComming;
        $this->website = $website;
        $this->product = $product;
    }

    public function addToCart(Request $request)
    {
        $product =  $this->product->findBySlug($request->slug);
        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                    $product->id => [
                        "name" => $product->title,
                        "quantity" => $product->qty,
                        "price" => $product->price
                    ]
            ];

            session()->put('cart', $cart);
        }

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] == $product->qty;
            session()->put('cart', $cart);
        }

        session()->put('cart', $cart);
    }

    public function checkout(Request $request)
    {
        $data = $request->all();
        $product =  $this->product->findBySlug($request->slug);
        
        return view('checkout', compact('data','product'));
    }

    public function procedCheckout(Request $request)
    {
        $orderDetail = json_decode($request->order_detail);
        $product =  $this->product->findBySlug($orderDetail->slug);
        $variant = resolve(\App\Repositories\Entities\ProductVariation::class)->find($orderDetail->variant);
        $edition = resolve(\App\Repositories\Entities\ProductEdition::class)->find($orderDetail->edition);

        $order = [
            'user_id' => logged_in_user()->id,
            'product_id' => $product->id,
            'variation' => $variant->variation->name,
            'qty' => $orderDetail->qty,
            'edition' => $edition->edition,
            'product_edition_id' => $edition->id,
            'total_price' => $orderDetail->qty * $product->price,
            'status' => 1,
        ];

        $orders = Order::create($order);

        $shipping = [
            'order_id' => $orders->id,
            'name' => $request->firstname.' '.$request->lastname,
            'country' => $request->country,
            'address' => $request->address,
            'optional_address' => $request->optional_address,
            'contact' => $request->contact,
        ];

        $shippingOrder = OrderShipping::create($shipping);

        return redirect()->route('order.success');
    }

    public function success(Request $request)
    {
        return view('order-success');
    }

}