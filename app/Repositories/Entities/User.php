<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    // use SoftDeletes;

	// protected $connection = 'mysql_adacuti';

    protected $guarded = ["id"];

}