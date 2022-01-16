<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\AuthenticationProduct;
use App\Repositories\Entities\Order;
use App\Repositories\Entities\OrderShipping;
use App\Facades\Paginator;
use App\Repositories\Entities\Product;
use App\Repositories\Entities\ProductEdition;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator as PaginationPaginator;

class AuthenticateProductController extends Controller
{

    public function index(Request $request)
    {
        $authenticates = AuthenticationProduct::when($request->email != '', function($q) use($request){
            $q->whereHas('user', function($q) use($request){
                $q->where('email', 'like', '%'.$request->email.'%');
            });
        })->when($request->date_order != '', function($q) use($request){
            $q->whereDate('date', date('Y-m-d', strtotime($request->date_order)));
        })->get();

        $orders = Order::has('product')->where('status', 2)
        ->when($request->email != '', function($q) use($request){
            $q->whereHas('user', function($q) use($request){
                $q->where('email', 'like', '%'.$request->email.'%');
            });
        })->when($request->date_order != '', function($q) use($request){
            $q->whereDate('created_at', date('Y-m-d', strtotime($request->date_order)));
        })->get();
        
        $data = $authenticates->merge($orders)->paginate(10);

        return view('admin.authenticate.index', compact('data'));
    }

    public function create()
    {
        return view('admin.authenticate.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->user_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'name' => $request->name,
                'product_id' => $request->product_id ?? null,
            ];

            AuthenticationProduct::create($data);

            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.authenticate.index');
    }

    public function edit(Request $request, $id)
    {
        if ($request->has('order')) {
            $order = Order::find($id);

            return view('admin.authenticate.edit-order', compact('order'));
        }
        $authenticate = AuthenticationProduct::find($id);

        return view('admin.authenticate.edit', compact('authenticate'));
    }

    public function update(Request $request, $id)
    {
        try {

            if ($request->has('order')) {
                $order = Order::find($id);
   
                $edition = ProductEdition::find($request->edition);
                $product = Product::find($request->product_id);
                $order = [
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'variation' => $request->variation,
                    'qty' => 1,
                    'edition' => $edition->edition,
                    'product_edition_id' => $request->edition,
                    'total_price' => 1 * $product->price,
                    'created_at' => date('Y-m-d', strtotime($request->created_at)),
                ];
        
                $orders = Order::where('id', $id)->update($order);
        
                $shipping = [
                    'name' => $request->name,
                    'country' => $request->country,
                    'address' => $request->address,
                    'optional_address' => $request->optional_address,
                    'contact' => $request->contact,
                ];
        
                $shippingOrder = OrderShipping::where('order_id', $id)->update($shipping);
            }else{
                $data = [
                    'user_id' => $request->user_id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'name' => $request->name,
                    'product_id' => $request->product_id ?? null,
                ];
    
                AuthenticationProduct::where('id', $id)->update($data);
            }


            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.authenticate.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            if ($request->has('order')) {
                Order::where('id', $id)->delete();
            }else{
                AuthenticationProduct::where('id', $id)->delete();
            }
            notice('success', 'Berhasil Dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.authenticate.index');
    }
}
