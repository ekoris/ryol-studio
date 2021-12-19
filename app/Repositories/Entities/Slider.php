<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Slider extends Model
{
    use HasSlug;

    protected $table = 'sliders';

    protected $guarded = ["id"];

    public function getFileUrlAttribute()
    {
        $file = false;
        $filesystem = config('filesystems.default');
        if (Storage::disk($filesystem)->exists('uploads/slider/'.$this->file)) {
            if($this->file != NULL){
                $file = Storage::disk($filesystem)->url('uploads/slider/'.$this->file);
            }
        }

        return $file;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

}