<?php

namespace App\Http\Controllers;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\ArtWorkRepository;
use App\Repositories\Entities\WebsiteManagement;
use App\Repositories\ProductRepository;
use App\Repositories\UpCommingRepository;
use App\Repositories\WebsiteManagementRepository;
use Illuminate\Support\Facades\Request;
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

    public function detailProduct(Request $request, $slug)
    {
        $params['slug_product'] =  $slug;
        $product = $this->product->findBySlug($slug);
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
}
