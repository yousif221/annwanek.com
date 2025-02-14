<?php

namespace App\Http\Controllers\Admin;

use App\Faqs;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $faqs = Faqs::orderBy('id','desc')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create() {
        return view('admin.faqs.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [ 
            'question' => 'required|string|max:1000',
         
            'answer' => 'required|string|max:1000',
        
            'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'question.required' => 'Please provide Question ',
            'answer.required' => 'Please provide Answer  ',
          
            'question.max' => 'Question can not have more than :max characters.',
            'answer.max' => 'Answer can not have more than :max characters.',

           
       
            // 'primaryImage.required' => 'Please provide Blog Primary Image',
            
            'primaryImage.mimes' => 'Please provide Blog Primary Image In jpeg,png,jpg Formats',
           
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $faqs =  new Faqs();
        $faqs->question = $request->input('question');
        $faqs->answer = $request->input('answer');
        $faqs->is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 100, 100, 'faqs');
            $faqs->image = $image;
        }
        $faqs->save();
        Session::flash('success','New Faqs Detail Has Been Added!');
        return redirect()->route('admin.faqs.index');
    }

    public function edit($id)
    {
        $faqs_detail = Faqs::findorFail($id);
        return view('admin.faqs.edit', compact('faqs_detail'));
    }

    public function update(Request $request)

    {
        $validator = Validator::make($request->all(), [ 
            'question' => 'required|string|max:1000',
         
            'answer' => 'required|string|max:1000',
        
            'primaryImage' => 'mimes:jpeg,jpg,png|max:500000',
            
        ],
        [ 
            'question.required' => 'Please provide Question ',
            'answer.required' => 'Please provide Answer  ',
          
            'question.max' => 'Question can not have more than :max characters.',
            
            'answer.max' => 'Answer can not have more than :max characters.',
       
            // 'primaryImage.required' => 'Please provide Blog Primary Image',
            
            'primaryImage.mimes' => 'Please provide Blog Primary Image In jpeg,png,jpg Formats',
           
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $faqs_update = Faqs::findorFail($request->faqs_id);

        $question = (($request->input('question') != null)? $request->input('question'): $faqs_update->question);
        $answer = ($request->input('answer') != null)? $request->input('answer'): $faqs_update->answer;
        $is_active = ($request->input('is_active') == 'checked') ? 1 : 0;
        if ($request->hasFile('primaryImage')) {
            $file = $request->file('primaryImage');
            $image = upload($file, 100, 100, 'faqs');
            $faqs_update->image = $image;
        }
  
        $faqs_update->update([
            'question'=> $question,
            'answer'=> $answer,
            'is_active'=>   $is_active,
        ]);
        Session::flash('success','Faqs Detail Has Been Updated Successfully!');
        return redirect()->route('admin.faqs.index');
    }

    public function destroy($id) {
        $faqs_detail = Faqs::findorFail($id);
        $faqs_detail->delete();
        Session::flash('success','Faqs Deleted Successfully');
        return redirect()->back();
    }
}
