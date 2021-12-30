<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug, SoftDeletes;

    protected $table = 'products';

    protected $guarded = ["id"];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getImageUrlAttribute()
    {
        $file = false;
        $filesystem = config('filesystems.default');
        if (Storage::disk($filesystem)->exists('uploads/image/'.$this->image)) {
            if($this->image != NULL){
                $file = Storage::disk($filesystem)->url('uploads/image/'.$this->image);
            }
        }

        return $file;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productUserPrivileges()
    {
        return $this->hasMany(ProductUserPrivilege::class, 'product_id', 'id');
    }
    
    public function productPhotos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }

    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

}