<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductEdition extends Model
{
    protected $table = 'product_editions';

    protected $guarded = ["id"];

}