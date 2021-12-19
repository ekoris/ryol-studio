<?php

namespace App\Repositories;

use App\Constants\CategoryType;
use App\Repositories\Entities\Product;

class HomeRepository {

    public function artWorkYearNavigation()
    {
        return Product::select('year')->where('product_type', CategoryType::ART_WORK)->groupBy('year')->get();
    }

    public function artWorkCategoryNavigation()
    {
        return Product::where('product_type', CategoryType::ART_WORK)->groupBy('category_id')->get();
    }

    public function upCommingYearNavigation()
    {
        return Product::select('year')->where('product_type', CategoryType::UP_COMMING_EVENT)->groupBy('year')->get();
    }

    public function upCommingCategoryNavigation()
    {
        return Product::where('product_type', CategoryType::UP_COMMING_EVENT)->groupBy('category_id')->get();
    }

}