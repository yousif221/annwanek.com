@extends('layouts.admin.app')
@section('title', 'Add Slider Info')
@section('before-css')
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/bootstrap-colorpicker.min.css')}}">
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
    </style>
@endsection
@section('content')
<div class="content">
        <h2 class="content-heading">Create Slide for {{ $heading->title }} <a href="{{route('admin.sliders.show_slide',$heading->id)}}" class="btn btn-alt-primary pull-right">Back</a></h2>

    <form action="{{ route('admin.sliders.store_slide', $heading->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">General Information</h3>
                        </div>
                        <div class="block-content block-content-full">
        <div class="form-group">
            <label for="title">Slide Title</label>
            <input type="text" name="title" id="title" class="form-control"></input>
            @if($errors->has('title'))
                                    <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('title') }}</div>
                                @endif
        </div>
        <div class="form-group">
            <label for="subtitle">Slide Sub Title</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control"></input>
            @if($errors->has('subtitle'))
               <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('subtitle') }}</div>
           @endif
        </div>
        <div class="form-group">
            <label for="content">Slide Content</label>
            <textarea name="content" id="content" class="form-control"></textarea>
             @if($errors->has('content'))
                  <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('content') }}</div>
              @endif
        </div>
        <!-- <div class="form-group">
            <label for="image">Slide Image</label>
            <input type="file" name="image" id="image" class="form-control">
             @if($errors->has('image'))
            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('image') }}</div>
            @endif
        </div> -->
    <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/select2.full.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
<script>
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
    jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each((index, element) => {
        jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
    });
</script>
@endsection

