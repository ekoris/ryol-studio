<?php

namespace App\Constants;

class CategoryType
{
    const PRODUCT = 1;
    const UP_COMMING_EVENT = 2;
    const ART_WORK = 3;

    public static function labels(): array
    {
        return [
            self::PRODUCT => "Product",
            self::UP_COMMING_EVENT => "Up Comming Event",
            self::ART_WORK => "Art Work",
        ];
    }

    public static function label($id = null)
    {   
        if($id != null)
            return static::labels()[$id];
        else
            return "-"; 
    }
}
