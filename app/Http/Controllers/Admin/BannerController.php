<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    public function edit($id)
    {
        $banner = Banner::findorFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    { 
        $this->validate($request, [
           
          'text'=>['required','string', 'max:255'],
        //   'banner_text'=>['required','string', 'max:255'],
            'image' => ['mimes:jpeg,png,jpg,gif'],

            // 'image_2' => ['mimes:jpeg,png,jpg,gif'],
        ], [
            'text.required' => 'Banner Title is required.',
           
            
        
            'image.mimes' => 'Display image should be in jpeg,png,jpg,gif format',
            // 'image_2.mimes' => 'Detailed image should be in jpeg,png,jpg,gif format',
        ]);
        if ($request->hasFile('image')) {
   
            $destination = $banner->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('storage/images/banner/'),$filename);
            $banner->image = 'storage/images/banner/'.$filename;
        }
        if ($request->hasFile('image_2')) {
            $destination_2 = $banner->image_2;
            if (File::exists($destination_2)) {
                File::delete($destination_2);
            }
            $file = $request->file('image_2');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('storage/images/banner/'),$filename);
            $banner->image_2 = 'storage/images/banner/'.$filename;
        }



        
        $banner->title = $request->input('text');
        $banner->text = $request->input('banner_heading');
        $banner->subtext = $request->input('banner_text');
        $banner->description = $request->input('description');
        $banner->save();
        Session::flash('success', 'Banner Information Updated Successfully!');
        return redirect()->route('admin.banners.index');

    }

    // public function uploadBanner(Request $request,Banner $banner ,$id) {

    //     if ($request->hasFile('banner')) {
    //         $file = $request->file('banner');
    //         $image = upload($file, 1420, 720, 'banner');
    //         $banner = Banner::findorFail($id);
    //         Storage::delete($banner->image);
    //         $banner->image = $image;
    //         $banner->save();
    //         return response()->json(['success' => $image]);
    //     }
    // }
}
