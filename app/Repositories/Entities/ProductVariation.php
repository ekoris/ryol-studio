<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductVariation extends Model
{
    protected $table = 'product_variations';

    protected $guarded = ["id"];

    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id', 'id');
    }


}