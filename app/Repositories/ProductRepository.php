<?php

namespace App\Repositories;

use App\Constants\CategoryType;
use App\Repositories\Entities\Product;
use App\Repositories\Entities\ProductUserPrivilege;

class ProductRepository {

    public function find($id)
    {
        return Product::find($id);
    }

    public function findBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    public function fetch($param = [], $paginate = false)
    {
        $query = Product::where('product_type', CategoryType::PRODUCT)->latest();

        if (logged_in_user()) {
            $query->where(function($q){
                $q->where('is_privilege', 0)->orWhereHas('productUserPrivileges', function($q){
                    $q->where('user_id', logged_in_user()->id)->where('is_privilege', 1);
                });
            });
        }else{
            $query->where('is_privilege', 0);
        }

        if (isset($param['q'])) {
            $query->where('title', 'like' , '%'.$param['q'].'%');
        }

        if (isset($param['year'])) {
            $query->where('year', $param['year']);
        }

        if (isset($param['category_id'])) {
            $query->where('category_id', $param['category_id']);
        }

        if (isset($param['slug_category'])) {
            $query->wherehas('category', function($q) use($param){
                $q->where('slug', $param['slug_category']);
            });
        }

        if (isset($param['slug_product'])) {
            $query->where('slug', $param['slug_product']);
        }

        if ($paginate) {
            return $query->paginate(30);
        }

        return $query->get();
    }

    public function create($data)
    {
        $productData = $data;
        unset($productData['users']);

        $product =  Product::create($productData);

        foreach (($data['users'] ?? []) as $key => $value) {
            ProductUserPrivilege::create([
                'user_id' => $value,
                'product_id' => $product->id
            ]);
        }
    }

    public function update($id, $data)
    {
        $product = Product::find($id);

        $productData = $data;
        unset($productData['users']);

        $product->update($productData);

        $product->refresh();
        ProductUserPrivilege::where('product_id', $id)->delete();
        foreach (($data['users'] ?? []) as $key => $value) {
            ProductUserPrivilege::create([
                'user_id' => $value,
                'product_id' => $id
            ]);
        }
    }

    public function delete($id)
    {
        return Product::find($id)->delete();
    }

}