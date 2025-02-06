@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('css')
    <link href="{{asset('a-asset/css/plugins/dropzone.css')}}">
    <style>
        .dropzone .dz-message {
            margin: 0px;
        }
        .dz-success-mark {
            display: none;
        }
        .dz-error-mark {
            display: none;
        }
        .dz-error-message{
            display: none;
        }
        .dz-details{
            display: none;
        }
    </style>
@endsection
@section('before-css')
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/summernote-bs4.css')}}">
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">{{$banner->page}} - Banner</h2>
    <div class="block">
        <div class="row">
            <div class="col-md-8 ">
                <form method="POST" class="p-20" action="{{route('admin.banners.update', $banner->id)}}" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class=" {{ ($banner->page == 'Home Page') ? 'col-6' : 'col-12' }} ">
                            <div class="form-material floating">
                                <input type="text" class="form-control" name="text" id="text" value="{{ $banner->title }}">
                                <label for="text">Banner Page</label>
                                @if($errors->has('text'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('text') }}</div>
                                        @endif
                            </div>
                        </div>
                    </div>
 
                  
                    @if($banner->page =='Index Page')
                    <div class="form-group row">
                        <div class=" {{ ($banner->page == 'Home Page') ? 'col-6' : 'col-12' }} ">
                            <div class="form-material floating">
                                <input type="text" class="form-control" name="banner_heading" id="banner_heading" value="{{ $banner->text }}">
                                <label for="banner_text">Banner text</label>
                                @if($errors->has('banner_heading'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('banner_heading') }}</div>
                                        @endif
                            </div>
                        </div>
                    </div>
                    
             
                    
                    @endif
                 
                                  <!-- <div class="form-group row">
                                        <div class="col-md-12">
                                        <div class="block-content block-content-full p-0">
                                                <label>Banner Text</label>
                                                <textarea style="height:100px;" name="banner_heading" class="form-control">{!!$banner->text!!}</textarea>
                                            </div>
                                        </div>
                                    </div> -->

            

                    
                            <div class="form-group row">
                            <div class="col-md-12 text-center">
                            <img src="{{asset($banner->image)}}" class="img-fluid pb-10">
                                <div class="block col-md-12">
                          
                          
                                     <input type="file" class="custom-file-input"  id="image"name="image" data-toggle="custom-file-input">
                                     <label class="custom-file-label" for="example-file-input-custom">Background Image</label>
                                 </div>
                                        @if($errors->has('image'))

                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('image') }}</div>
                                          @endif
                         
                                          </div>  </div>
                                          <!-- @if($banner->page =='Index Page')
                                          <div class="form-group row">
                                          <div class="col-md-12 text-center">
                              <img src="{{asset($banner->image_2)}}" class="img-fluid pb-10"style="height:90px;">
                                <div class="block col-md-12">
                                     <input type="file" class="custom-file-input"  id="image_2"name="image_2" data-toggle="custom-file-input">
                                     <label class="custom-file-label" for="example-file-input-custom"> Image</label>
                                 </div>
                                        @if($errors->has('image_2'))

                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('image_2') }}</div>
                                          @endif
                                          </div>
                                          </div>
@endif -->
                          

                    @csrf
                    @method('PUT')
                    <div class="col-md-6 offset-md-3">
                        <input type="submit" value="Update Information" class="btn btn-primary m-30">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('a-asset/js/plugins/dropzone.min.js')}}"></script>
    <script src="{{asset('a-asset/js/plugins/select2.full.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
    <script>
        Dropzone.options.banner = {
            paramName: "banner",
            dictDefaultMessage: "<img src='{{asset($banner->image)}}' style='width: 465px; height: 220px' />",
            maxFiles: 1,
            acceptedFiles: 'image/*',
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '465px', height: '220px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
            }
        };

   

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
    function uploadImage(image) {
        let data = new FormData();
        data.append("image", image);
        data.append( "_token", "{{ csrf_token() }}");
        console.log(data);
        $.ajax({
            url: "{{route('admin.business.descriptionImage')}}",
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
    jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each((index, element) => {
        jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
    });
    </script>
@endsection
