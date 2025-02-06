<?php

namespace App\Http\Controllers\Admin;

use App\Tournament;
use App\Tags;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tournaments = Tournament::all();
        return view('admin.tournament.index', compact('tournaments'));
    }

    public function create() {
        return view('admin.tournament.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [ 
              'title' => 'required|string|max:255',        
             'address'=>'required|max:255',
             'short_description'=>'required|max:255',
             'date'=>'required',
             'start_time'=>'required',
             'end_time'=>'required',

             'primaryImage' => 'required|mimes:jpeg,jpg,png|required|max:500000',
            //  'inner_image' => 'required|mimes:jpeg,jpg,png|required|max:500000',


        ],
        [ 
            'title.required' => 'Please provide Title ',  
            'title.max' => 'title can not have more than :max characters.',
            'description.required'=>'Description Is Required',
            'primaryImage.required' => 'Please provide Tournament Primary Image',
            'primaryImage.mimes' => 'Please provide Tournament Primary Image In jpeg,png,jpg Formats',
            // 'inner_image.required' => 'Please provide Tournament Detail Image',
            // 'inner_image.mimes' => 'Please provide Tournament Detail Image In jpeg,png,jpg Formats',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $tournament =  new Tournament();
        $tournament->title = $request->input('title');
        $tournament->address = $request->input('address');

        $tournament->date = $request->input('date');
        $tournament->start_time = $request->input('start_time');
        $tournament->end_time = $request->input('end_time');

        $tournament->short_description = $request->input('short_description');

        $tournament->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 1280, 426, 'tournament');
            $tournament->primary_image = $image;
        }
    
        $tournament->save();
        Session::flash('success','Tournament Added Successfully');
        return redirect()->route('admin.tournament.index');
    }

    public function edit($id)
    {
        $tournaments_detail = Tournament::findorFail($id);
        return view('admin.tournament.edit', compact('tournaments_detail'));
    }

    public function update(Request $request, Tournament $tournament)
    {

        $validator = Validator::make($request->all(), [ 
           'title' => 'required|string|max:255',        
           'address'=>'required|max:255',
           'short_description'=>'required|max:255',
           'date'=>'required',
           'start_time'=>'required',
           'end_time'=>'required',
           'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
      ],
      [ 
          'title.required' => 'Please provide Title ',  
          'title.max' => 'title can not have more than :max characters.',
          'description.required'=>'Description Is Required',
          'primaryImage.required' => 'Please provide Tournament Primary Image',
          'primaryImage.mimes' => 'Please provide Tournament Primary Image In jpeg,png,jpg Formats',
      ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $tournament->title = ($request->input('title') != null)? $request->input('title'): $tournament->title;
        $tournament->address = ($request->input('address') != null)? $request->input('address'): $tournament->address;
        $tournament->date = ($request->input('date') != null)? $request->input('date'): $tournament->date;
        $tournament->start_time = ($request->input('start_time') != null)? $request->input('start_time'): $tournament->start_time;
        $tournament->end_time = ($request->input('end_time') != null)? $request->input('end_time'): $tournament->end_time;

        $tournament->short_description = ($request->input('short_description') != null)? $request->input('short_description'): $tournament->short_description;  

        $tournament->is_active = (isset($request->is_active))? 1: 0;

        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 1280, 426, 'tournament');
            $tournament->primary_image = $image;
        }
    
        $tournament->save();
        Session::flash('success', "tournament Updated Successfully!");
        return redirect()->route('admin.tournament.index');
    }
    public function feature($id) {
        $tournament = Tournament::findorFail($id);
        $tournament->is_featured = !$tournament->is_featured;
        $tournament->save();
        if($tournament->is_featured)
            Session::flash('success', "Tournament is marked as featured successfully!");
        else
            Session::flash('success', "Tournament is unmarked from featured inventory!");
        return redirect()->back();
    }
    public function destroy($id) {
        $tournament = Tournament::findorFail($id);
        $tournament->delete();
        Session::flash('success','Tournament Deleted Successfully');
        return redirect()->back();
    }
}
