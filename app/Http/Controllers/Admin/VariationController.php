<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\VariationRepository;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function __construct(VariationRepository $variation)
    {
        $this->variation = $variation;
    }

    public function index(Request $request)
    {
        $variations = $this->variation->fetch($request->all(), true);

        return view('admin.variation.index', compact('variations'));
    }

    public function create()
    {
        return view('admin.variation.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name
            ];
            $this->variation->create($data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.variation.index');
    }

    public function edit($id)
    {
        $variation = $this->variation->find($id);

        return view('admin.variation.edit', compact('variation'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'name' => $request->name
            ];
            $this->variation->update($id, $data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.variation.index');
    }
}
