<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }
    public function create() {
        return view('admin.slider.create');
    }
    public function store(Request $request) {
          // Check if there are already 4 sliders stored for this page
    $maxSlidersPerPage = 4;
    $page = $request->input('page');
    $existingSlidersCount = Slider::where('page', $page)->count();

    if ($existingSlidersCount >= $maxSlidersPerPage) {
        return redirect()->back()->withErrors(['page' => 'This page already has the maximum allowed number of sliders (4).'])->withInput();
    }
        $validator = Validator::make($request->all(), [ 

            'background_image' => 'required|mimes:jpeg,jpg,png|required|max:500000',
            'featured_image'=> 'required|mimes:jpeg,jpg,png|required|max:500000',
            'page' => 'required',

        ],
        [
            
            'page.required'=> 'Please provide Page',

            'featured_image'.'required'=> 'Please provide slider  Image',
            'background_image.required' => 'Please provide slider Background Image',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slider =  new Slider();
        $slider->page = $request->input('page');


        $slider->is_active = ($request->is_active == 'checked') ? 1 : 0;
   
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $image = upload($file, 1500, 800, 'slider-background');
            $slider->background_image = $image;
        }
        
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $image = upload($file, 1500, 800, 'slider-featured_image');
            $slider->primary_image = $image;
        }
      
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filePath = 'videos/'  . uniqid() . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/'.$filePath, file_get_contents($file));
            $slider->video = 'storage/'.$filePath;
        }
        $slider->save();
        Session::flash('success',"New Slider Info has Been Added Successfully!");
        return redirect()->route('admin.slider.index');
    }
    public function edit($id)
    {
        $slider = Slider::findorFail($id);
        return view('admin.slider.edit', compact('slider'));
    }
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [ 
            
            'page' => 'required',
            'text' => 'required|max:255',

            'sub_text' => 'required|max:255',


        ],
        [
            'page.required'=> 'Please provide Page',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slider->page = ($request->input('page') != null)? $request->input('page'): $slider->page;
        ;
        $slider->text = ($request->input('text') != null)? $request->input('text'): $slider->text;
        $slider->sub_text = ($request->input('sub_text') != null)? $request->input('sub_text'): $slider->sub_text;
        $slider->is_active = ($request->is_active == 'checked') ? 1 : 0;
  
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $image = upload($file, 1500, 800, 'slider');
            $slider->background_image = $image;
        }
        
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $image = upload($file, 1500, 800, 'slider');
            $slider->primary_image = $image;
        }
        

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filePath = 'videos/'  . uniqid() . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/'.$filePath, file_get_contents($file));
            $slider->video = 'storage/'.$filePath;
        }
        $slider->save();
        Session::flash('success',"Slider Detail has Been Updated Successfully!");
        return redirect()->route('admin.slider.index');
    }
    public function destroy($id) {
        $slider = Slider::findorFail($id);
        $slider->delete();
        Session::flash('success', "Slider deleted Successfully!");
        return redirect()->back();
    }
}