<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{

    protected $table = 'product_photos';

    protected $guarded = ["id"];

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
}