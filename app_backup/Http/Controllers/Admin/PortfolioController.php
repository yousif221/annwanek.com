<?php

namespace App\Http\Controllers\Admin;

use App\Portfolio;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create() {
        return view('admin.portfolio.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'description' => 'required|string',        
            'primaryImage' => 'required|mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'name.required' => 'Please provide Name ',         
            'name.max' => 'Name can not have more than :max characters.', 
            'description.required' => 'Please provide Description ',         
            'primaryImage.required' => 'Please provide portfolio  Image',            
            'primaryImage.mimes' => 'Please provide portfolio Primary Image In jpeg,png,jpg Formats',
           
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $portfolio =  new Portfolio();
        $portfolio->name = $request->input('name');
   
        $portfolio->description = $request->input('description');
        $portfolio->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 966 , 400, 'portfolios');
            $portfolio->image = $image;
        }
        $portfolio->save();
        Session::flash('success','New Portfolio Detail Has Been Added!');
        return redirect()->route('admin.portfolio.index');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findorFail($id);
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'name.required' => 'Please provide Name ',
            'name.max' => 'Name can not have more than :max characters.',
            'description.required' => 'Please provide Description ',            
            'primaryImage.mimes' => 'Please provide portfolio Image In jpeg,png,jpg Formats',
           
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $portfolio->name = ($request->input('name') != null)? $request->input('name'): $portfolio->name;
        $portfolio->description = ($request->input('description') != null)? $request->input('description'): $portfolio->description;
        $portfolio->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 966 , 400, 'portfolio');
            $portfolio->image = $image;
        }
        $portfolio->save();
        Session::flash('success','Portfolio Detail Has Been Updated Successfully!');
        return redirect()->route('admin.portfolio.index');
    }

    public function destroy($id) {
        $portfolio = Portfolio::findorFail($id);
        $portfolio->delete();
        Session::flash('success','Portfolio Deleted Successfully');
        return redirect()->back();
    }
}
