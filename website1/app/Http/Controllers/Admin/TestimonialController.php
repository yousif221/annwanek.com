<?php

namespace App\Http\Controllers\Admin;

use App\Testimonial;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create() {
        return view('admin.testimonial.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'name' => 'max:255',
            'review' => 'required|string',
            'designation' => 'max:255',  
        
            // 'primaryImage' => 'required|mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'name.required' => 'Please provide Name ',         
            'name.max' => 'Name can not have more than :max characters.', 
            'designation.required' => 'Please provide designation ',  
            'review.required' => 'Please provide Reviews ',         
            'review.max' => 'review can not have more than :max characters.',      
            'primaryImage.required' => 'Please provide Testimonial Client Image',            
            'primaryImage.mimes' => 'Please provide Testimonial Primary Image In jpeg,png,jpg Formats',
           
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $testimonial =  new Testimonial();
        $testimonial->name = $request->input('name');
   
        $testimonial->review = $request->input('review');
        $testimonial->rating = $request->input('rating');
        $testimonial->designation = $request->input('designation');
        $testimonial->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 250, 250, 'testimonial');
            $testimonial->image = $image;
        }
        $testimonial->save();
        Session::flash('success','New Testimonial Detail Has Been Added!');
        return redirect()->route('admin.testimonial.index');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findorFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'max:255',
            'designation' => 'max:255',
            'review' => 'required|string',
         
        
            // 'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'name.required' => 'Please provide Name ',
          
            'name.max' => 'Name can not have more than :max characters.',
            
            'designation.required' => 'Please provide designation review ',
          
            'designation.max' => 'designation can not have more than :max characters.',
            'review.required' => 'Please provide Reviews ',
          
            'review.max' => 'review can not have more than :max characters.',
            
            'primaryImage.mimes' => 'Please provide Testimonial client  Image In jpeg,png,jpg Formats',
           
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $testimonial->name = $request->input('name') !== null ? $request->input('name') : null;
        $testimonial->rating = ($request->input('rating') != null)? $request->input('rating'): $testimonial->rating;

        $testimonial->review = ($request->input('review') != null)? $request->input('review'): $testimonial->review;
        $testimonial->designation = $request->input('designation') != null? $request->input('designation') : null;;
        $testimonial->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 250, 250, 'testimonial');
            $testimonial->image = $image;
        }
        $testimonial->save();
        Session::flash('success','Testimonial Detail Has Been Updated Successfully!');
        return redirect()->route('admin.testimonial.index');
    } 
    
    public function feature($id) {
        $testimonial = Testimonial::findorFail($id);
        $testimonial->is_featured = !$testimonial->is_featured;
        $testimonial->save();
        if($testimonial->is_featured)
            Session::flash('success', "testimonial is marked as featured successfully!");
        else
            Session::flash('success', "testimonial is unmarked from featured!");
        return redirect()->back();
    }

    public function destroy($id) {
        $testimonial = Testimonial::findorFail($id);
        $testimonial->delete();
        Session::flash('success','Testimonial Deleted Successfully');
        return redirect()->back();
    }
}
