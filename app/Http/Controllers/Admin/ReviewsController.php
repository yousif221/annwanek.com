<?php

namespace App\Http\Controllers\Admin;

use App\Reviews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reviews = Reviews::orderBy('id','desc')->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create() {
        return view('admin.reviews.create');
    }

    public function store(Request $request) {
        $reviews =  new Reviews();
        $reviews->name = $request->input('name');
        $reviews->review = $request->input('review');
        $reviews->review = $request->input('reviews');
        $reviews->description = $request->input('description');
        $reviews->rating = $request->input('rating');
        $reviews->is_featured = ($request->input('is_featured') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 100, 100, 'reviews');
            $reviews->image = $image;
        }
        $reviews->save();
        Session::flash('success','New Reviews Detail Has Been Added!');
        return redirect()->route('admin.reviews.index');
    }

    public function feature($id) {
        $reviews = Reviews::findorFail($id);
        $reviews->is_featured = !$reviews->is_featured;
        $reviews->save();
        if($reviews->is_featured)
            Session::flash('success', "Product is marked as featured successfully!");
        else
            Session::flash('success', "Product is unmarked from featured product!");
        return redirect()->back();
    }
    public function edit($id)
    {
        $reviews_detail = Reviews::findorFail($id);
        return view('admin.reviews.edit', compact('reviews_detail'));
    }

    public function update(Request $request)
    {
   
        $validator = Validator::make($request->all(), [ 

            'name' => 'required|string|max:255', 
            'inquiry_email' => 'required|email',
            'primaryImage' => [ 'mimes:jpeg,png,jpg,gif','max:2048'],
            'food'=>'required',
            'service'=>'required',
            'value'=>'required',
            'atmosphere'=>'required',
            'review'=>'required',
        ],
        [ 
            'reviews.required' => 'Please provide your Reviews',
            'name.required' => 'Please provide your  name',
            'name.max' => ' name can not exceed :max characters',
            'name.regex' => 'Name can only contain alphabets',
            'inquiry_email.required' => 'Please provide an Email',
            'inquiry_email.email' => 'Email format is not correct',
            'inquiry_email.regex'=>'Email format should be complete.',
            'primaryImage.max'=> 'Your File must be 2MB',
            'primaryImage.mimes'=>'Files must be jpeg,png,jpg,gif Format '
       
           
            
           
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $reviews_update = Reviews::findorFail($request->reviews_id);
        $reviews_update->first_name = ($request->input('name') != null)? $request->input('name'): $reviews_update->first_name;
        $reviews_update->email = ($request->input('inquiry_email') != null)? $request->input('inquiry_email'): $reviews_update->email;
        $reviews_update->review = ($request->input('review') != null)? $request->input('review'): $reviews_update->review;
        $reviews_update->food = ($request->input('food') != null)? $request->input('food'): $reviews_update->food;
        $reviews_update->value = ($request->input('value') != null)? $request->input('value'): $reviews_update->value;
        $reviews_update->service = ($request->input('service') != null)? $request->input('service'): $reviews_update->service;
        $reviews_update->atmosphere= ($request->input('atmosphere') != null)? $request->input('atmosphere'): $reviews_update->atmosphere;


        $reviews_update->is_featured = ($request->input('is_featured') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 100, 100, 'reviews');
            $reviews_update->image = $image;
        }
        $reviews_update->update();
        Session::flash('success','Reviews Detail Has Been Updated Successfully!');
        return redirect()->route('admin.reviews.index');
    
    

    }
    public function destroy($id) {
        $reviews_detail = Reviews::findorFail($id);
        $reviews_detail->delete();
        Session::flash('success','reviews Deleted Successfully');
        return redirect()->back();
    }
}
