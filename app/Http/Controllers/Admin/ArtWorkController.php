<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CategoryType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\ArtWorkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use File;

class ArtWorkController extends Controller
{
    public function __construct(ArtWorkRepository $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product->fetch($request->all(), true);

        return view('admin.art-work.index', compact('products'));
    }

    public function create()
    {
        return view('admin.art-work.create');
    }

    public function store(Request $request)
    {   try {
            $data = [
                'title' => $request->title,
                'year' => $request->year,
                'description' => $request->description,
                'product_type' => CategoryType::ART_WORK,
                'category_id' => $request->category_id
            ];

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
            
            $this->product->create($data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.art-work.index');
    }

    public function edit($id)
    {
        $product = $this->product->find($id);

        return view('admin.art-work.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'title' => $request->title,
                'year' => $request->year,
                'description' => $request->description,
                'category_id' => $request->category_id
            ];

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

        return redirect()->route('admin.art-work.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->product->delete($id);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.art-work.index');
    }
}
