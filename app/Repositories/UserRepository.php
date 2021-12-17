<?php

namespace App\Repositories;

use App\Repositories\Entities\User;

class UserRepository {

    public function fetch($params = [], $perPage = false)
    {
        $query = User::orderBy('id', 'desc');

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}