<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\CvRepository;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function __construct(CvRepository $cv)
    {
        $this->cv = $cv;
    }

    public function index(Request $request)
    {
        $cv = $this->cv->fetch($request->all(), true);

        return view('admin.cv.index', compact('cv'));
    }

    public function create()
    {
        return view('admin.cv.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'year' => $request->year,
                'description' => $request->description,
            ];
            $this->cv->create($data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.cv.index');
    }

    public function edit($id)
    {
        $cv = $this->cv->find($id);

        return view('admin.cv.edit', compact('cv'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'year' => $request->year,
                'description' => $request->description,
            ];
            $this->cv->update($id, $data);
            notice('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.cv.index');
    }

    public function delete($id)
    {
        try {
            $this->cv->delete($id);
            notice('success', 'Berhasil Dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.cv.index');
    }
}
