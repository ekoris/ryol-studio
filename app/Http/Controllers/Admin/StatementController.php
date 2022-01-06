<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Entities\User;
use App\Repositories\Entities\WebsiteManagement;
use App\Repositories\UserRepository;
use App\Repositories\WebsiteManagementRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StatementController extends Controller
{

    public function __construct(UserRepository $user, WebsiteManagementRepository $website)
    {
        $this->user = $user;
        $this->website = $website;
    }

    public function index(Request $request)
    {
        $website = $this->website->first();  
        return view('admin.statement', compact('website'));
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'cv' => $request->cv ?? '-',
            ];

            $this->website->aboutPost($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.statement.index');
    }

}
