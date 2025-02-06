<?php

namespace App\Http\Controllers\Admin;

use App\Blog;

use App\State;
use App\Tags;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create() {
        $states = State::where('is_active',1)->get();
        return view('admin.blogs.create',compact('states'));
    }

    public function store(Request $request) {
     
        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string|max:255',
            'state' => 'required',

             'description'=>'required',
             'name'=>'required|string|max:255',
             'primaryImage' => 'required|mimes:jpeg,jpg,png|required|max:500000',
             'inner_image' => 'required|mimes:jpeg,jpg,png|required|max:500000',

        ],
        [ 
            'title.required' => 'Please provide Title ',
          
            'title.max' => 'title can not have more than :max characters.',
            'name.required' => 'Please provide User Name ',
          
            'name.max' => 'User Name can not have more than :max characters.',
           
            'description.required'=>'Description Is Required',
            'primaryImage.required' => 'Please provide Blog Primary Image',
            
            'primaryImage.mimes' => 'Please provide Blog Primary Image In jpeg,png,jpg Formats',
           
            'inner_image.required' => 'Please provide Blog Primary Image',
            
            'inner_image.mimes' => 'Please provide Blog Primary Image In jpeg,png,jpg Formats',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $blog =  new Blog();
        $blog->title = $request->input('title');
        $blog->username = $request->input('name');
        $blog->state_id = $request->input('state');

        $blog->description = $request->input('description');
        $blog->additionalinfo = $request->input('additionalinfo');
        $blog->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 1280, 426, 'blogs');
            $blog->primary_image = $image;
        }
       
        if ($request->hasFile('inner_image')) {
            $file = $request->file('inner_image');
            $image = upload($file, 663, 416, 'blogs-inner');
            $blog->inner_image = $image;
        }
        $blog->save();
        Session::flash('success','Blog Added Successfully');
        return redirect()->route('admin.blog.index');
    }

    public function edit($id)
    {
        $states = State::where('is_active',1)->get();

        $blogs_detail = Blog::findorFail($id);
        return view('admin.blogs.edit', compact('blogs_detail','states'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
          'description'=>'required',
          'state' => 'required',

            'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'title.required' => 'Please provide Title ',
          
            'title.max' => 'title can not have more than :max characters.',

            'name.required' => 'Please provide User Name ',
          
            'name.max' => 'User Name can not have more than :max characters.',
            'description.required'=>'Description Is Required',
           
       
            // 'primaryImage.required' => 'Please provide Blog Primary Image',
            
            'primaryImage.mimes' => 'Please provide Blog Primary Image In jpeg,png,jpg Formats',
            'inner_image.mimes' => 'Please provide Blog Inner Image In jpeg,png,jpg Formats',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $blog->title = ($request->input('title') != null)? $request->input('title'): $blog->title;
        $blog->username = ($request->input('name') != null)? $request->input('name'): $blog->username;
        $blog->state_id = ($request->input('state') != null)? $request->input('state'): $blog->state_id;

        $blog->description = ($request->input('description') != null)? $request->input('description'): $blog->description;
        $blog->additionalinfo = ($request->input('additionalinfo') != null)? $request->input('additionalinfo'): $blog->additionalinfo;
  
        $blog->is_active = (isset($request->is_active))? 1: 0;

        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 1280, 426, 'blogs');
            $blog->primary_image = $image;
        }
        if ($request->hasFile('inner_image')) {
            $file = $request->file('inner_image');
            $image = upload($file, 663, 416, 'blogs-inner');
            $blog->inner_image = $image;
        }
        $blog->save();
        Session::flash('success', "Blog Updated Successfully!");
        return redirect()->route('admin.blog.index');
    }
    public function feature($id) {
        $blog = Blog::findorFail($id);
        $blog->is_featured = !$blog->is_featured;
        $blog->save();
        if($blog->is_featured)
            Session::flash('success', "blog is marked as featured successfully!");
        else
            Session::flash('success', "blog is unmarked from featured inventory!");
        return redirect()->back();
    }
    public function destroy($id) {
        $blog = Blog::findorFail($id);
        $blog->delete();
        Session::flash('success','Blog Deleted Successfully');
        return redirect()->back();
    }
}
