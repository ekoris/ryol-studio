<?php

namespace App\Repositories;

use App\Repositories\Entities\Slider;
use App\Repositories\Entities\WebsiteManagement;
use Illuminate\Support\Facades\Storage;

class WebsiteManagementRepository {

    public function first()
    {
        return WebsiteManagement::first();
    }

    public function aboutPost($data)
    {
        return WebsiteManagement::updateOrCreate(['id' => 1],$data);
    }

    public function sliders()
    {
        return Slider::get();
    }

    public function sliderPost($data)
    {
        if (isset($data['upload_exist'])) {
            Slider::whereNotIn('id', $data['upload_exist'])->delete();

            foreach ($data['upload_exist'] as $key => $value) {
                $update = [
                    'title' => $data['name_exist'][$value],
                    'year' => $data['year_exist'][$value],
                ];
                if (isset($data['file_exist'][$value])) {
                    $update['file'] = $this->upload($data['file_exist'][$value]);
                }
                Slider::updateOrCreate(
                    [
                        'id' => $value
                    ],
                    $update
                );
            }
        }

        if (isset($data['file'])) {
            foreach ($data['file'] as $key => $value) {
                if (isset($value)) {
                    $value = [
                        'title' => $data['name'][$key] ?? null,
                        'year' =>  $data['year'][$key] ?? null,
                        'file' => $this->upload($value)
                    ];
    
                    Slider::create($value);
                }
            }
        }
    }

    private function upload($file)
    {
        $filename = $file->getClientOriginalName();
        if(!Storage::disk('public')->exists($filename)) { 
            $path = Storage::disk('public')->putFileAs(
                'uploads/slider',
                $file,
                $filename
            );
    
            Storage::setVisibility($path, 'public');        
        }

        return $file->getClientOriginalName();
    }
}