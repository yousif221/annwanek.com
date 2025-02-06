<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Config;
use Image;

class CmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $contents = Content::all();
        return view('admin.cms.index', compact('contents'));
    }
    public function edit(Content $content) {
        $contents = Content::all()->where('section', $content->section);
        return view('admin.cms.edit', compact('contents'));
    }
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'content.*.title' => 'nullable|string|max:55',
            'content.*.subtitle' => 'nullable|string|max:255',
        ],[
            'content.*.title.max' => 'title can not have more than :max characters.',
            'content.*.subtitle.max' => 'Subtitle can not have more than :max characters.',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach ($request->input('content') as $id => $content) {
            $section = Content::where('id', $id)->first();
            $section->button_text = (isset($content['button_text']))? $content['button_text']: null;
            $section->btn_color = (isset($content['button_color']))? $content['button_color']: null;
            $section->link = (isset($content['button_link']))? $content['button_link']: null;
            $section->title = (isset($content['title']))? $content['title']: null;
            $section->subtitle = (isset($content['subtitle']))? $content['subtitle']: null;
            $section->short_description = (isset($content['short_description']))? $content['short_description']: null;
            $section->description = (isset($content['description']))? $content['description']: null;
            if(isset($request['content'][$id]['video'])) {
                $file = $request['content'][$id]['video'];
                $fileName = uniqid() . time() . '.' . $file->getClientOriginalExtension();
                $path = 'storage/videos';
                $file->move(public_path($path), $fileName);
                $section->video = $path.'/'.$fileName;
            }
            $section->save();
        }
        Session::flash('success', 'Content Has Been Updated Successfully!');
        return redirect()->route('admin.content');
    }
    public function config() {
        return view('admin.cms.config');
    }
    public function updateLogo(Request $request) {
        if ($request->hasFile('logo')) {
            $this->validate($request, [
             
                  'logo' => ['required', 'mimes:jpeg,png,jpg,gif'],
                  
              ], [
                  'logo.required' => 'Please provide display image',
                  'logo.mimes' => 'Display image should be in :mimes format',
           
              ]);
            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            if ($extention == 'gif') {
                $image = '/storage/images/'.time().'.'.$extention;
                $file->move(public_path('/storage/images/'),$image);
            }
            else{
                $file = $request->file('logo');
                $image = upload($file, 263, 148);
            }
            $config = Config::where('key', 'logo')->first();
        }

        if ($request->hasFile('favicon')) {
            $this->validate($request, [
             
                'favicon' => ['required', 'mimes:jpeg,png,jpg,gif'],
                
            ], [
                'favicon.required' => 'Please provide display image',
                'favicon.mimes' => 'Display image should be in :mimes format',
         
            ]);
            $file = $request->file('favicon');
            $image = upload($file, 164, 49);
            $config = Config::where('key', 'favicon')->first();
        }

        if ($request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $image = upload($file, 360, 23);
            $config = Config::where('key', 'footer_logo')->first();
        }
        $config->value = $image;
        $config->save();
        return response()->json(['success' => $image]);
    }

    public function updateLogoVideo(Request $request){
        if ($request->hasFile('logo')) {
            $file= $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $image = 'storage/images/'. time().'1.'.$extention;
            $file->move(public_path('storage/images/'),$image);
            
            $config = Config::where('key', 'logo')->first();
            $config->value = $image;
            $config->save();
            Session::flash('success', 'Logo Updated Successfully!');
            return redirect()->back();
        }
    }

    public function updateConfig(Request $request) {
        $input = $request->except('_token');
        foreach($input as $key => $value) {
            $config = Config::where('key', $key)->first();
            $config->value = $value;
            $config->save();
        }
        Session::flash('success', 'Website Configuration Updated Successfully!');
        return redirect()->back();
    }

    public function updateCommission(Request $request) {
        if(intval($request->input('seller_bd_commission')) + intval($request->input('parent_commission')) + intval($request->input('admin_commission')) + intval($request->input('onwer_bd_commission')) != 100) {
            return redirect()->back()->withErrors(['commission' => 'Sum of Distributed Commission should be equal to 100%'])->withInput();
        }
        $input = $request->except('_token');
        foreach($input as $key => $value) {
            $config = Config::where('key', $key)->first();
            $config->value = ($value)? $value: 0;
            $config->save();
        }
        Session::flash('success', 'Commission Distributions Updated Successfully!');
        return redirect()->back();
    }

    public function updateFees(Request $request) {
        $input = $request->except('_token');
        foreach($input as $key => $value) {
            $config = Config::where('key', $key)->first();
            $config->value = ($value)? $value: 0;
            $config->save();
        }
        Session::flash('success', 'Fee Payments Updated Successfully!');
        return redirect()->back();
    }

    public function updateImage(Request $request, $id) {
        if ($request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $image = upload($file, 600, 700, 'content');
            $content = Content::findorFail($id);
            $content->primary_image = $image;
        }
        if ($request->hasFile('secondary_image')) {
            $file = $request->file('secondary_image');
            $image = upload($file, 600, 700, 'content');
            $content = Content::findorFail($id);
            $content->secondary_image = $image;
        }
        $content->save();
        return response()->json(['success' => $image]);
    }
}
