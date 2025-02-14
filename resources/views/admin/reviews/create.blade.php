@extends('layouts.admin.app')
@section('title','Testimonials')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Adding New Reviews <a href="{{route('admin.reviews.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.reviews.store')}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <input type="text" class="form-control" name="name" required="required">
                                        <label>Name</label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <input type="text" class="form-control" name="designation" required="required">
                                        <label>Designation</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <label>Review Rating</label>
                                        <select name="rating" class="form-control" required="required">
                                            <option value="1">1 Star Rating</option>
                                            <option value="2">2 Star Rating</option>
                                            <option value="3">3 Star Rating</option>
                                            <option value="4">4 Star Rating</option>
                                            <option value="5">5 Star Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating m-20">
                                        <textarea class="form-control" name="reviews" rows="8" required="required"></textarea>
                                        <label>Review</label>
                                    </div>
                                </div>
                            </div>
                       
                        
                            <div class="col-md-4">
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
                                       <input type="submit" class="btn btn-primary m-30" value="Add reviews">
                                </div>
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
