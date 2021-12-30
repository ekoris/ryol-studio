<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\Product;
use App\Repositories\Entities\ProductPhoto;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product->fetch($request->all(), true);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'year' => $request->year,
                'description' => $request->description,
                'product_type' => CategoryType::PRODUCT,
                'category_id' => $request->category_id,
                'is_privilege' => $request->type_product,
                'date_production' => date('Y-m-d', strtotime($request->date_production)),
                'variations' => $request->variations,
                'price' => $request->price,
                'qurency' => $request->qurency,
                'is_sold' => $request->is_sold ?? 0,
            ];

            if ($request->type_product == 1) {
                $data['users'] = $request->users;
            }

            if($request->hasFile('image')) { 
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                if(!Storage::disk('public')->exists($filename)) { 
                    $path = storage_path('app/public/uploads/image');
                    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                    $image = $request->file('image');
                 
                    $filePath = storage_path('app/public/uploads/image');
            
                    $img = Image::make($image->path());
                    $img->resize(1000, 1000, function ($const) {
                        $const->aspectRatio();
                    })->save($filePath.'/'.$filename);
                }

                $data['image'] = $file->getClientOriginalName();
            }

            if($request->has('images')) { 
                foreach ($request->images as $key => $value) {
                    $folderPath = storage_path('app/public/uploads/image/');
                    $image_parts = explode(";base64,", $value);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid().'.'.$image_type;
                    $file = $folderPath . $fileName;
                    $path = $folderPath . $fileName;
                    $input = File::put($path, $image_base64);
                    $image = Image::make($path);
                    $image->resize(1000, 1000, function ($const) {
                        $const->aspectRatio();
                    })->save($path);
                    $images[] = $fileName;
                }

                $data['images'] = $images;
            }

            $this->product->create($data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $product = $this->product->find($id);

        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'title' => $request->title,
                'year' => $request->year,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'is_privilege' => $request->type_product,
                'date_production' => date('Y-m-d', strtotime($request->date_production)),
                'variations' => $request->variations,
                'price' => $request->price,
                'qurency' => $request->qurency,
                'is_sold' => $request->is_sold ?? 0,
            ];

            if ($request->type_product == 1) {
                $data['users'] = $request->users;
            }

            if ($request->has('images_before')) {
                $this->removeImage($id, $request->images_before);
            }

            if($request->has('images')) { 
                foreach ($request->images as $key => $value) {
                    $folderPath = storage_path('app/public/uploads/image/');
                    $image_parts = explode(";base64,", $value);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid().'.'.$image_type;
                    $file = $folderPath . $fileName;
                    $path = $folderPath . $fileName;
                    $input = File::put($path, $image_base64);
                    $image = Image::make($path);
                    $image->resize(1000, 1000, function ($const) {
                        $const->aspectRatio();
                    })->save($path);
                    $images[] = $fileName;
                }
                
                $data['images'] = $images;
            }

            if($request->hasFile('image')) { 
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                if(!Storage::disk('public')->exists($filename)) { 
                    $path = storage_path('app/public/uploads/image');
                    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                    $image = $request->file('image');
                 
                    $filePath = storage_path('app/public/uploads/image');
            
                    $img = Image::make($image->path());
                    $img->resize(1000, 1000, function ($const) {
                        $const->aspectRatio();
                    })->save($filePath.'/'.$filename);
                }

                $data['image'] = $file->getClientOriginalName();
            }

            $this->product->update($id, $data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.product.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->product->delete($id);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.product.index');
    }

    private function removeImage($productId, $image)
    {
        $productPhotos = ProductPhoto::where('product_id', $productId)->whereNotIn('image', $image)->get();
        foreach ($productPhotos as $key => $value) {
            unlink(storage_path('app/public/uploads/image/'.    $value->image));
        }

        ProductPhoto::where('product_id', $productId)->whereNotIn('image', $image)->delete();
    }
}
