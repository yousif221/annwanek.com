<?php

namespace App\Http\Controllers\Admin;
// app/Http/Controllers/SliderController.php
// namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Heading;
use App\Slide;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index()
    {
        $headings = Heading::get();
    
        return view('admin.sliders.index', compact('headings'));
    }

    public function createHeading()
    {
        return view('admin.sliders.create_heading');
    }

    public function storeHeading(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Handle image upload
        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = upload($file, 1500, 800, 'heading-images');
        }
     
        
        // Create the heading
        Heading::create([
            'title' => $request->input('title'),
            'image' => $image
        ]);
    
        return redirect()->route('admin.sliders.index')->with('success', 'Heading created successfully.');
    }
    public function editHeading($headingId)
    {
       
        $heading = Heading::findOrFail($headingId);
        return view('admin.sliders.edit_heading', compact('heading'));
    }
    public function updateHeading(Request $request ,$headingId)
    {
      
        $heading = Heading::findOrFail($headingId);
     
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $heading->title = $request->input('title');
  
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = upload($file, 1500, 800, 'heading-images');
            $heading->image = $image;
        }
        
        $heading->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Heading Updated successfully.');
    }
  
    public function deleteHeading($headingId)
    {
        $heading = Heading::findOrFail($headingId);
        $heading->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'heading deleted successfully.');
    }

    public function createSlide($headingId)
    {
        $heading = Heading::findOrFail($headingId);
        return view('admin.sliders.create_slide', compact('heading'));
    }

    public function storeSlide(Request $request, $headingId)
    {

        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string|max:23',
            'subtitle' => 'required|string|max:23',

            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slide = new Slide;
        $slide->heading_id = $headingId;
        
        $slide->content = $request->input('content');
        $slide->title = $request->input('title');   
        $slide->subtitle = $request->input('subtitle');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = upload($file, 1500, 800, 'slider-image');
            $slide->image = $image;
        }
        $slide->save();
        return redirect()->route('admin.sliders.show_slide',$slide->heading_id)->with('success', 'Slide created successfully.');
    }
    public function showSlide(Request $request, $headingId)
    {
        $heading =Heading::findorFail($headingId);
        $slide = Slide::where('heading_id',$headingId)->get();
        
        return view('admin.sliders.show', compact('slide','heading'));
    }
    public function editSlide($id)
    {
       
        $slide = Slide::findOrFail($id);
        return view('admin.sliders.edit_slide', compact('slide'));
    }

    public function updateSlide(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string|max:23',
            'subtitle' => 'required|string|max:23',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slide->content = $request->input('content');
        $slide->title = $request->input('title');
        $slide->subtitle = $request->input('subtitle');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = upload($file, 1500, 800, 'slider-image');
            $slide->image = $image;
        }

        $slide->save();
        return redirect()->route('admin.sliders.show_slide',$slide->heading_id)->with('success', 'Slide updated successfully.');
    }

    public function deleteSlide($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
        return redirect()->route('admin.sliders.show_slide',$slide->heading_id)->with('success', 'Slide deleted successfully.');
    }
}