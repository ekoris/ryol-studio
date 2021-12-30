<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cv';

    protected $guarded = ["id"];

}