@extends('layouts.admin.app')
@section('title','Faqs')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Adding New Faqs <a href="{{route('admin.faqs.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.faqs.store')}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                          
                        <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating m-20">
                                        <textarea class="form-control" id="ds" name="question" rows="8"> {{old('question')}}</textarea>
                                        <label for="ds">Faqs Question</label>
                                    </div>
                                    @if($errors->has('question'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('question') }}</div>
                                    @endif
                                </div>
                               
                            </div>

                         
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating m-20">
                                        <textarea class="form-control" id="asd" name="answer" rows="8" > {{old('answer')}}</textarea>
                                        <label for="asd">Faqs Answer</label>
                                    </div>
                                    @if($errors->has('answer'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('answer') }}</div>
                                    @endif
                                </div>
                                
                            </div>
    
                          
                               <div class="form-group row text-center">
                                   <label class="col-12">Published</label>
                                        <div class="col-12">
                                           <label class="css-control css-control-success css-switch">
                                             <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{(old('is_active'))? (old('is_active') == 'checked')? 'checked': '':''}}>
                                               <span class="css-control-indicator"></span>
                                           </label>
                                       </div>
                                   </div>
                                 
                              <div class="form-group row text-center">
                                    <div class="col-md-12">
                                       <input type="submit" class="btn btn-primary m-30" value="Add Faqs">
                                </div>
                             
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
