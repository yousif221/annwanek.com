@extends('layouts.admin.app')
@section('title', 'Updating Tournament - '.$tournaments_detail->title)
@section('before-css')
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/summernote-bs4.css')}}">
@endsection
@section('css')
    <style>
        ::placeholder, .custom-file-label, .select2-selection__placeholder {
            color: #adadadda !important;
            opacity: 1;
        }
        :-ms-input-placeholder, .custom-file-label, .select2-selection__placeholder {
            color: #adadadda !important;
        }
        ::-ms-input-placeholder, .custom-file-label, .select2-selection__placeholder {
            color: #adadadda !important;
        }
        #submit_product {
            border: 1px solid #3e4d5f;
            background-color: #f0f2f5;
            color: #374659;
        }
        a.btn.btn-alt-primary.change_padding{
            padding: 11px 15px;
            border: 1px solid #125a96;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Tournaments #{{$tournaments_detail->id}} ({{$tournaments_detail->name}}) <a href="{{route('admin.tournament.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.tournament.update', $tournaments_detail->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-10">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Tournaments Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12">Title</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="title" placeholder="title" value="{{(old('title'))?old('title'):$tournaments_detail->title}}">
                                    @if($errors->has('title'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                            </div>
                     
                            <div class="form-group row">
                                <label class="col-12">Address</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="address" value="{{(old('address'))?old('address'):$tournaments_detail->address}}">
                                    @if($errors->has('address'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                                                    <!-- Date Field -->
                            <div class="col-12 mt-3">
                                <label class="col-12">Tournament Date</label>
                                <div class="col-12 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" value="{{(old('date'))?old('date'):$tournaments_detail->date}}" name="date" placeholder="Tournament Date">
                                </div>
                                @if($errors->has('date'))
                                    <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('date') }}</div>
                                @endif
                            </div>

                            <!-- Start Time Field -->
                            <div class="col-12 mt-3">
                                <label class="col-12">Start Time</label>
                                <div class="col-12 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" class="form-control" value="{{(old('start_time'))?old('start_time'):$tournaments_detail->start_time}}" name="start_time" placeholder="Start Time">
                                </div>
                                @if($errors->has('start_time'))
                                    <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('start_time') }}</div>
                                @endif
                            </div>

                            <!-- End Time Field -->
                            <div class="col-12 mt-3">
                                <label class="col-12">End Time</label>
                                <div class="col-12 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="time" class="form-control" value="{{(old('end_time'))?old('end_time'):$tournaments_detail->end_time}}" name="end_time" placeholder="End Time">
                                </div>
                                @if($errors->has('end_time'))
                                    <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('end_time') }}</div>
                                @endif
                            </div>
                                
                
            
                    <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="block-content block-content-full p-0">
                                        <label class="col-12">tournament Short Description</label>
                                        <div class="col-12">
                                        <textarea name="short_description" class="form-control"style="height:300px;" value="{{(old('short_description'))?old('short_description'):$tournaments_detail->short_description}}">{{(old('short_description'))?old('short_description'):$tournaments_detail->short_description}}</textarea>
                                        </div>
                                        @if($errors->has('short_description'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('short_description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>  



                  
                            <div class="block block-rounded block-themed">
                              <div class="block-header bg-gd-primary">
                              <h3 class="block-title">Tournaments Image</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row gutters-tiny items-push">
                                <img src="{{asset($tournaments_detail->primary_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="primaryImage" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change tournament's Featured Image</label>
                                    </div>
                                    @if($errors->has('primaryImage'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('primaryImage') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                 
                    </div>
                          
                    @method('PUT')
                    <div class="block block-rounded block-themed">
                        <div class="block-content block-content-full">
                            @if(auth()->user()->hasRole('Administrator'))
                            <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($tournaments_detail->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12 mb-0">
                                    <div class="block text-center">
                                        <button type="submit" id="submit_product" class="btn btn-lg">
                                            <i class="fa fa-save mr-5"></i>
                                            @if(auth()->user()->hasRole('Administrator'))
                                                update tournaments
                                            @else
                                                update tournaments
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
            <input type="hidden" name="tournaments_id" value="{{ $tournaments_detail->id }}">
        </form>
    </div>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/select2.full.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
<script>
 
    jQuery('.js-select2:not(.js-select2-enabled)').each((index, element) => {
        let el = jQuery(element);
        el.addClass('js-select2-enabled').select2({
            placeholder: el.data('placeholder') || false
        });
    });
    jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
        let el = jQuery(element);
        el.addClass('js-summernote-enabled').summernote({
            height: el.data('height') || 350,
            minHeight: el.data('min-height') || null,
            maxHeight: el.data('max-height') || null,
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });
    });
    $(".blogs_tags").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    function uploadImage(image) {
        let data = new FormData();
        data.append("image", image);
        data.append( "_token", "{{ csrf_token() }}");
        console.log(data);
        $.ajax({
            url: "{{route('admin.product.descriptionImage')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(filename) {
                var image = $('<img>').attr('src', filename).addClass("img-fluid");
                $('.js-summernote').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    function itemType(e) {
        if(e.value == 'single') {
            $('.item-count').css('display', 'none');
        }
        else {
            $('.item-count').css('display', 'block');
        }
    }
</script>
@endsection
