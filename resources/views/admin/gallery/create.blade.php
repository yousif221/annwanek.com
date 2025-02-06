@extends('layouts.admin.app')
@section('title', 'Add Slider Info')
@section('css')
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('a-asset/css/plugins/dropzone.css')}}">
    <style>
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
@section('content')
    <div class="content">
        <h2 class="content-heading">Adding new Image To the Gallery <a href="{{route('admin.gallery.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.gallery.store')}}" id="createPost" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6 offset-3">
                            <!-- <label class="mt-20">Blog Team Member Image</label> -->
                            <div class="block col-md-12">
                                <input type="file" class="custom-file-input" id="example-file-input-custom" name="primaryImage" data-toggle="custom-file-input">
                                <label class="custom-file-label" for="example-file-input-custom">Choose Image</label>
                            </div>
                            <!-- <label class="mt-20">Blog Post Secondary Image</label>
                            <div class="block col-md-12">
                                <input type="file" class="custom-file-input" id="example-file-input-custom" name="secondaryImage" data-toggle="custom-file-input">
                                <label class="custom-file-label" for="example-file-input-custom">Choose Blog Post Secondary Image</label>
                            </div> -->
                        </div>
                    </div>
                    @csrf
                    <div class="col-md-12 text-center">
                    <input type="submit" id="publishFaq" class="btn btn-primary m-30" value="Add Image">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('a-asset/js/plugins/bootstrap-colorpicker.min.js')}}"></script>
    <script>
        jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
            let el = jQuery(element);
            el.addClass('js-summernote-enabled').summernote({
                height: el.data('height') || 350,
                minHeight: el.data('min-height') || null,
                maxHeight: el.data('max-height') || null
            });
        });
        jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each((index, element) => {
            jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
        });
    </script>
@endsection
