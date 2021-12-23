<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductUserPrivilege extends Model
{
    use SoftDeletes;

    protected $table = 'product_user_privileges';

    protected $guarded = ["id"];

    public function category()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}