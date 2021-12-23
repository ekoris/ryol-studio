<?php

namespace App\Http\Controllers;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\ArtWorkRepository;
use App\Repositories\Entities\Order;
use App\Repositories\Entities\User;
use App\Repositories\Entities\WebsiteManagement;
use App\Repositories\ProductRepository;
use App\Repositories\UpCommingRepository;
use App\Repositories\WebsiteManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function __construct(ArtWorkRepository $artWork, WebsiteManagementRepository $website, UpCommingRepository $upComming, ProductRepository $product)
    {
        $this->artWork = $artWork;
        $this->upComming = $upComming;
        $this->website = $website;
        $this->product = $product;
    }

    public function index()
    {
        return view('admin.theme.master');
    }

    public function artWork(Request $request, $param)
    {
        if (is_numeric($param)) {
            $params['year'] =  $param;
        }else{
            $params['slug_category'] =  $param;
        }

        $products = $this->artWork->fetch($params, false);
        return view('art-work', compact('param', 'products'));
    }

    public function upComming(Request $request, $param)
    {
        if (is_numeric($param)) {
            $params['year'] =  $param;
        }else{
            $params['slug_category'] =  $param;
        }

        $products = $this->upComming->fetch($params, false);
        return view('up-comming', compact('param', 'products'));
    }

    public function store(Request $request)
    {
        $products = $this->product->fetch([], false);
        return view('store', compact('products'));
    }

    public function detailProduct(Request $request, $slug)
    {
        $params['slug_product'] =  $slug;
        $product = $this->product->findBySlug($slug);

        if ($product->is_privilege == 1) {
            if (logged_in_user()) {
                $authorize = $product->whereHas('productUserPrivileges', function($q){
                    $q->where('user_id', logged_in_user()->id);
                })->first();

                if (!$authorize) {
                    return redirect('/');
                }
            }
        }


        $qrcode = QrCode::size(200)->generate(route('detail-product', $product->slug));

        return view('detail-product', compact('params','slug', 'product','qrcode'));
    }

    public function cv()
    {
        $website = $this->website->first();

        return view('cv', compact('website'));
    }

    public function contactUs()
    {
        $website = $this->website->first();

        return view('contact-us', compact('website'));
    }

    public function login()
    {
        return view('login');
    }

    public function doRegister(Request $request)
    {
        $password = Hash::make($request->password);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'status' => 0,
            'no_contact' => $request->number
        ];

        $user = User::create($data);
        $user->assignRole('user');

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect()->route('auth.login')->with(['error' => true]);
        }
    }

    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect()->route('auth.login')->with(['error' => true]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function profile(Request $request)
    {
        return view('profile');
    }

    public function updateProfile (Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_contact' => $request->number
        ];
        
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', logged_in_user()->id)->update($data);
        return redirect('/');
    }

    public function orders(Request $request)
    {
        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'note' => 'Wa',
        ]);

        return response('oke', 200);
    }
}
