<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WebsiteManagement extends Model
{
    protected $table = 'website_managements';

    protected $guarded = ["id"];

    public function getLogoUrlAttribute()
    {
        $file = false;
        $filesystem = config('filesystems.default');
        if (Storage::disk($filesystem)->exists('uploads/logo/'.$this->logo)) {
            if($this->logo != NULL){
                $file = Storage::disk($filesystem)->url('uploads/logo/'.$this->logo);
            }
        }

        return $file;
    }

}