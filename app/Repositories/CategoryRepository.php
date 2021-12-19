<?php

namespace App\Repositories;

use App\Repositories\Entities\Category;

class CategoryRepository {

    public function find($id)
    {
        return Category::find($id);
    }

    public function fetch($param = [], $paginate = false)
    {
        $query = Category::latest();

        if (isset($param['q'])) {
            $query->where('title', 'like' , '%'.$param['q'].'%');
        }

        if (isset($param['type'])) {
            $query->where('type', $param['type']);
        }

        if ($paginate) {
            return $query->paginate(30);
        }

        return $query->get();
    }

    public function create($data)
    {
        return Category::create($data);
    }

    public function update($id, $data)
    {
        return Category::find($id)->update($data);
    }

}