<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::findorFail($id);
        $categories = Category::all();
        return view('admin.category.index', compact(['category', 'categories']));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', 'unique:category,slug'],
            'primaryimage' => ['required','mimes:jpeg,jpg,png', 'max:500000'],
            'small_image' => ['required','mimes:jpeg,jpg,png', 'max:500000'],
            'short_description' => [ 'string', 'max:500'],
            'available_count' => ['required','integer'],


        ], [
            'title.required' => 'Category Title is required.',
            'title.max' => 'Category can not have more than :max characters.',
            'slug.unique' => 'Provide a more unique and user-friendly Category slug.',
            'slug.alpha_dash' => 'Slug should Contain only Alpha-numeric character and underscore(-)',
            // 'primaryimage.required'=>  'Category Image is Required',
            // 'primaryimage.mimes'=>  'please Insert jpeg,jpg,png Image type',
        ]);
        $category = new Category();
        $category->name = $request->input('title');
        $category->slug = $request->input('slug');
        $category->short_description = $request->input('short_description');
        $category->available_count = $request->input('available_count');

        
        $category->is_active = ($request->input('is_active') == 'on')? 1: 0;
        
        if ($request->hasFile('small_image')) {
            $file = $request->file('small_image');
            $image = upload($file, 1280, 426, 'category');
            $category->small_image = $image;
        }
        
        if ($request->hasFile('primaryimage')) {
            $file = $request->file('primaryimage');
            $image = upload($file, 1280, 426, 'category');
            $category->primary_image = $image;
        }
        
        $category->save();
        Session::flash('success', "Category Added Successfully!");
        return redirect()->back();
    }
    public function feature($id) {
        $category = Category::findOrFail($id);
    
        // Check if the category is currently not featured and there are already 2 featured categories
        if (!$category->is_featured && Category::where('is_featured', 1)->count() >= 5) {
            Session::flash('error', "Only five categories can be marked as featured at a time!");
            return redirect()->back();
        }
    
        // Toggle the featured status
        $category->is_featured = !$category->is_featured;
        $category->save();
    
        // Flash appropriate success message
        if ($category->is_featured) {
            Session::flash('success', "Category is marked as featured successfully!");
        } else {
            Session::flash('success', "Category is unmarked from featured product!");
        }
    
        return redirect()->back();
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', 'unique:category,slug,'.$category->id],
            'short_description' => ['string', 'max:500'],
            'available_count' => ['required','integer'],
            'small_image' => ['mimes:jpeg,jpg,png', 'max:500000'],
            'primaryimage' => ['mimes:jpeg,jpg,png', 'max:500000'],

        ], [
            'title.required' => 'Brand Title is required.',
            'title.max' => 'Title can not have more than :max characters.',
            'slug.unique' => 'Provide a more unique and user-friendly Category slug.',
            'slug.alpha_dash' => 'Slug should Contain only Alpha-numeric character and underscore(-)'
        ]);
        $category->name = $request->input('title');
        $category->slug = $request->input('slug');
        $category->short_description = $request->input('short_description');
        $category->available_count = $request->input('available_count');

        $category->is_active = ($request->input('is_active') == 'on')? 1: 0;
        if ($request->hasFile('primaryimage')) {
            $file = $request->file('primaryimage');
            $image = upload($file, 1280, 426, 'category');
            $category->primary_image = $image;
        }
        if ($request->hasFile('small_image')) {
            $file = $request->file('small_image');
            $image = upload($file, 40, 40, 'category');
            $category->small_image = $image;
        }
        $category->save();
        Session::flash('success', "Category Updated Successfully!");
        return redirect()->route('admin.category.index');
    }

    public function destroy($id) {
        $brand = Category::findorFail( $id );
        $brand->delete();
        Session::flash('success', "Category Deleted Successfully!");
        return redirect()->route('admin.category.index');
    }
}
