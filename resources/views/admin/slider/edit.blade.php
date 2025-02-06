@extends('layouts.admin.app')
@section('title', 'Updating Slider - '.$slider->id)
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
        <h2 class="content-heading">Editiing Slider # ({{$slider->id}}) <a href="{{route('admin.slider.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.slider.update', $slider->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-12">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Page</h3>
                        </div>
                      <br>
                        <div class="block">
                        <select id="heading" class="form-control" name="page">
                            <option value="" disabled>Select a page</option>
                            <option value="Home Page" {{ $slider->page == 'Home Page' ? 'selected' : '' }}>Home Page</option>
                        </select>
                        @if($errors->has('page'))
                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('page') }}</div>
                        @endif
                        </div>
                      <br>   
                         <div class="form-group row">
                                        <div class="col-md-12">
                                             <div class="block-content block-content-full p-0">
                                                <labe class="col-12">Slider heading</label>
                                                <input  name="sub_text" class="form-control" value="{{$slider->sub_text}}">
                                            </div>
                                            @if($errors->has('sub_text'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('sub_text') }}</div>
                                    @endif
                                        </div>
                                      
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                             <div class="block-content block-content-full p-0">
                                                <labe class="col-12">Slider Text</label>
                                                <input  name="text" class="form-control" value="{{$slider->text}}">
                                            </div>
                                            @if($errors->has('text'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('text') }}</div>
                                    @endif
                                        </div>
                                     
                                    </div>
                                    </div>


                            <div class="block block-rounded block-themed">
                               <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <img src="{{asset($slider->primary_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="featured_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change slider Image</label>
                                    </div>
                                    @if($errors->has('featured_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('featured_image') }}</div>
                                    @endif
                                </div>
                            </div>
                 

                    
     
                  
                        <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title"> Second Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <img src="{{asset($slider->background_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="background_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change slider Second Image</label>
                                    </div>
                                    @if($errors->has('background_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('background_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @method('PUT')
                    <div class="block block-rounded block-themed">
                        <div class="block-content block-content-full">
                            <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($slider->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12 mb-0">
                                    <div class="block text-center">
                                        <button type="submit" id="submit_product" class="btn btn-lg">
                                            <i class="fa fa-save mr-5"></i>
                                                update slider
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    </div>
                        </div>
                    </div>
               
                
            </div>
            @csrf
        </form>
    </div>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/select2.full.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
<script>
    $('#name').keyup(function() {
        let text = $(this).val().toLowerCase();
        text = text.replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(text);
    });
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
    $(".product_tags").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
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
</script>
@endsection
