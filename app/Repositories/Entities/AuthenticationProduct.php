<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AuthenticationProduct extends Model
{
    protected $table = 'authentication_products';

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}