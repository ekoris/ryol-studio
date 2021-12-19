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

class UserController extends Controller
{

    public function __construct(UserRepository $user, WebsiteManagementRepository $website)
    {
        $this->user = $user;
        $this->website = $website;
    }

    public function index(Request $request)
    {
        $users = $this->user->fetch($request->all(), 15);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            User::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.user.index');
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if (isset($request->password)) {
               $data['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.user.index');
    }

    public function delete($id)
    {
        try {
            User::where('id', $id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.user.index');
    }

    public function profile(Request $request)
    {
        return view('admin.profile');
    }

    public function profileUpdate(Request $request, $id)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if (isset($request->password)) {
                $data['password'] = Hash::make($request->password);
             }

            User::where('id', $id)->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.user.profile');
    }

    public function about(Request $request)
    {
        $website = $this->website->first();        
        return view('admin.about', compact('website'));
    }

    public function aboutStore(Request $request)
    {
        try {
            $data = [
                'tagline' => $request->tagline,
                'about' => $request->about ?? '-',
                'cv' => $request->cv ?? '-'
            ];
    
            if($request->hasFile('logo')) { 
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                if(!Storage::disk('public')->exists($filename)) { 
                    $path = Storage::disk('public')->putFileAs(
                        'uploads/logo',
                        $file,
                        $filename
                    );
            
                    Storage::setVisibility($path, 'public');        
                }

                $data['logo'] = $file->getClientOriginalName();
            }

            $this->website->aboutPost($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        notice('success', 'Success');
        return redirect()->route('admin.about.index');
    }

    public function slider(Request $request)
    {
        $sliders = $this->website->sliders();        
        return view('admin.slider', compact('sliders'));
    }

    public function sliderStore(Request $request)
    {
        try {
            $this->website->sliderPost($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        notice('success', 'Success');
        return redirect()->route('admin.slider.index');
    }

}
