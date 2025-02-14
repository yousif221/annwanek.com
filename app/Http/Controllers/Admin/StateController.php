<?php

namespace App\Http\Controllers\Admin;

use App\State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $states = State::all();
        return view('admin.state.index', compact('states'));
    }

    public function edit($id)
    {
        $state = State::findorFail($id);
        $states = State::all();
        return view('admin.state.index', compact(['state', 'states']));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'primaryimage' => ['required','mimes:jpeg,jpg,png', 'max:500000'],


        ], [
            'title.required' => 'state Title is required.',
            'title.max' => 'state can not have more than :max characters.',
            'slug.alpha_dash' => 'Slug should Contain only Alpha-numeric character and underscore(-)',
        ]);
        $state = new State();
        $state->name = $request->input('title');

        
        $state->is_active = ($request->input('is_active') == 'on')? 1: 0;
        
        if ($request->hasFile('small_image')) {
            $file = $request->file('small_image');
            $image = upload($file, 1280, 426, 'State');
            $state->primary_image = $image;
        }
        
        if ($request->hasFile('primaryimage')) {
            $file = $request->file('primaryimage');
            $image = upload($file, 1280, 426, 'state');
            $state->primary_image = $image;
        }
        
        $state->save();
        Session::flash('success', "state Added Successfully!");
        return redirect()->back();
    }
    public function feature($id) {
        $state = State::findOrFail($id);
    
        if (!$state->is_featured && State::where('is_featured', 1)->count() >= 5) {
            Session::flash('error', "Only five state can be marked as featured at a time!");
            return redirect()->back();
        }
    
        // Toggle the featured status
        $state->is_featured = !$state->is_featured;
        $state->save();
    
        // Flash appropriate success message
        if ($state->is_featured) {
            Session::flash('success', "State is marked as featured successfully!");
        } else {
            Session::flash('success', "State is unmarked from featured product!");
        }
    
        return redirect()->back();
    }

    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'primaryimage' => ['mimes:jpeg,jpg,png', 'max:500000'],

        ], [
            'title.required' => 'Brand Title is required.',
            'title.max' => 'Title can not have more than :max characters.',
        ]);
        $state->name = $request->input('title');

        $state->is_active = ($request->input('is_active') == 'on')? 1: 0;
        if ($request->hasFile('primaryimage')) {
            $file = $request->file('primaryimage');
            $image = upload($file, 1280, 426, 'State');
            $state->primary_image = $image;
        }
    
        $state->save();
        Session::flash('success', "State Updated Successfully!");
        return redirect()->route('admin.state.index');
    }

    public function destroy($id) {
        $state = State::findorFail( $id );
        $state->delete();
        Session::flash('success', "state Deleted Successfully!");
        return redirect()->route('admin.state.index');
    }
}
