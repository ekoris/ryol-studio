<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\Product;
use App\Repositories\Entities\ProductEdition;
use App\Repositories\Entities\ProductVariation;
use App\Repositories\Entities\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class JsonController extends Controller
{

    public function orderVariation(Request $request)
    {
        $query = ProductVariation::latest();

        if ($request->has('q')) {
            $query->whereHas('variation', function($q) use($request){
               $q->where('name', $request->q);
            });
        }

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $query = $query->get();

		$data = [];
		foreach ($query as $key => $row) {
			$data[$row->id]['id'] = $row->variation->name;
			$data[$row->id]['text'] = $row->variation->name;
        }

        $data = array_values($data);
		$data = ['results' => $data];

		return response()->json($data);
    }

    public function orderEdition(Request $request)
    {
        $query = ProductEdition::latest();

        if ($request->has('q')) {
            $query->where('edition', $request->q);
        }

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $query = $query->get();

		$data = [];
		foreach ($query as $key => $row) {
			$data[$row->id]['id'] = $row->id;
			$data[$row->id]['text'] = $row->edition;
        }

        $data = array_values($data);
		$data = ['results' => $data];

		return response()->json($data);
    }

}
