<?php

namespace App\Repositories;

use App\Repositories\Entities\Cv;

class CvRepository {

    public function find($id)
    {
        return Cv::find($id);
    }

    public function fetch($param = [], $paginate = false)
    {
        $query = Cv::latest();

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
        return Cv::create($data);
    }

    public function update($id, $data)
    {
        return Cv::find($id)->update($data);
    }

}