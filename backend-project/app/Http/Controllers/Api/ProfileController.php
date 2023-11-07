<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $id = $request->get('id');
        // $user = User::find($id)->first();
        $user = auth()->user();
        $request->validate([
            'new_name'=>['required','min:3','max:255'],
            'new_tel'=>['numeric','nullable']
        ]);
        $fileName = null;
        $fileNameImage = null;
        $fileNameBanner = null;
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $fileNameImage = $file->getClientOriginalName();
            $path = 'public/images/' . $fileNameImage;
            Storage::disk('local')->put($path,file_get_contents($file));
            $user->profile_image = $fileNameImage;
        }
        if ($request->hasFile('banner_path')) {
            $file = $request->file('banner_path');
            $fileNameBanner = $file->getClientOriginalName();
            $path = 'public/images/' . $fileNameBanner;
            Storage::disk('local')->put($path,file_get_contents($file));
            $user->banner = $fileNameBanner;
        }
        $new_name = $request->get('new_name');
        if($new_name !== null){
            $user->name = $new_name;
        }
        $new_tel = $request->get('new_tel');
        if($new_tel !== null){
            $user->tel = $new_tel;
        }
        // $user->name = $new_name;
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
