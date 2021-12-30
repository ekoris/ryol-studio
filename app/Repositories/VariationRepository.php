<?php

namespace App\Repositories;

use App\Repositories\Entities\Variation;

class VariationRepository {

    public function find($id)
    {
        return Variation::find($id);
    }

    public function fetch($param = [], $paginate = false)
    {
        $query = Variation::latest();

        if (isset($param['q'])) {
            $query->where('name', 'like' , '%'.$param['q'].'%');
        }

        if ($paginate) {
            return $query->paginate(30);
        }

        return $query->get();
    }

    public function create($data)
    {
        return Variation::create($data);
    }

    public function update($id, $data)
    {
        return Variation::find($id)->update($data);
    }

}