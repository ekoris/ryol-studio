<?php

namespace App\Repositories;

use App\Constants\CategoryType;
use App\Repositories\Entities\Order;

class OrderRepository {

    public function fetch($param = [], $paginate = false)
    {
        $query = Order::latest();

        if (isset($param['product'])) {
            $query->whereHas('product', function($q) use($param){
                $q->where('title', 'like' , '%'.$param['product'].'%');
            });
        }

        if (isset($param['user'])) {
            $query->whereHas('user', function($q) use($param){
                $q->where('name', 'like' , '%'.$param['user'].'%');
            });
        }

        if (isset($param['created'])) {
            $query->whereDate('created_at', date('Y-m-d', strtotime($param['created'])));
        }

        if ($paginate) {
            return $query->paginate(30);
        }

        return $query->get();
    }

    public function countOrder()
    {
        return Order::where('status', 1)->get()->count() ?? 0;
    }

}