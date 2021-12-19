<?php

namespace App\Repositories;

use App\Constants\CategoryType;
use App\Repositories\Entities\Product;

class ArtWorkRepository {

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
        $query = Product::where('product_type', CategoryType::ART_WORK)->latest();

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
        return Product::create($data);
    }

    public function update($id, $data)
    {
        return Product::find($id)->update($data);
    }

    public function delete($id)
    {
        return Product::find($id)->delete();
    }

}