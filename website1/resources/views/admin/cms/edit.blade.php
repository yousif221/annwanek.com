@extends('layouts.admin.app')
@section('title', 'Edit '.$contents->first()->page.' Content')
@section('css')
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
        <h2 class="content-heading">Editing {{$contents->first()->page}} - {{$contents->first()->section}} Content <a href="{{route('admin.content')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.content.update')}}" enctype="multipart/form-data">
                    @foreach($contents as $content)
                        <div class="row">
                            <div class="col-md-8">
                              @if($content->id != 30&&$content->id != 29&&$content->id != 27&&$content->id != 9&&$content->id != 137&&$content->id != 82 &&$content->id != 83 && $content->id != 130)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary floating m-20">
                                                <input type="text" class="form-control" id="title"name="content[{{$content->id}}][title]" value="{{$content->title}}">
                                                <label for ="title" >Title</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('content.*.title'))
                                        <div class="text-danger ml-5 font-weight-bold">
                                        {{ $errors->first('content.*.title') }}
                                        </div>
                                    @endif
                               @endif
                                    @if($content->subtitle != null)
                                  
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary floating m-20">
                                                <input type="text" class="form-control" name="content[{{$content->id}}][subtitle]" value="{{$content->subtitle}}">
                                                <label>Sub Title</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('content.*.subtitle'))
                                        <div class="text-danger ml-5 font-weight-bold">
                                        {{ $errors->first('content.*.subtitle') }}
                                        </div>
                                    @endif
                                    
                               @endif
                               @if($content->short_description != null)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material floating m-20">
                                                <textarea class="form-control" name="content[{{$content->id}}][short_description]" rows="8"><?= html_entity_decode($content->short_description) ?></textarea>
                                                <label>Short Description</label>
                                            </div>
                                        </div>
                                    </div>
                                 
                                    @endif
                                    @if($content->description != null)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="block-content block-content-full">
                                                <label>Description</label>
                                                <textarea name="content[{{$content->id}}][description]" class="js-summernote">{!!$content->description!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @if($content->button_text != null && $content->link != null)
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="form-material form-material-primary floating mt-20">
                                            <input type="text" class="form-control" name="content[{{$content->id}}][button_text]" value="{{$content->button_text}}">
                                            <label>Button Text</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-material form-material-primary floating mt-20">
                                            <input type="text" class="js-colorpicker form-control" name="content[{{$content->id}}][button_color]" data-format="hex" value="{{$content->btn_color}}">
                                            <label>Button Color</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-material form-material-primary floating mt-20">
                                            <input type="text" class="form-control" name="content[{{$content->id}}][button_link]" value="{{$content->link}}">
                                            <label>Button Link</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                @if($content->primary_image != null)
                                    <div class="block">
                                        <div class="block-content block-content-full">
                                            <div class="dropzone" id="primaryImage{{$content->id}}"  style="background-color: #6e80db;"></div>
                                            <small>Click on the image to upload a new Image.</small>
                                        </div>
                                    </div>
                                @endif
                                @if($content->secondary_image != null)
                                    <div class="block">
                                        <div class="block-content block-content-full">
                                            <div class="dropzone" id="secondaryImage{{$content->id}}"  style="background-color: #6e80db;"></div>
                                            <small>Click on the image to upload a new Image.</small>
                                        </div>
                                    </div>
                                @endif
                                @if($content->video != null)
                                    <div class="form-group row  mt-20">
                                        <label class="col-12">Video</label>
                                        <video src="{{asset($content->video)}}" autoplay class="img-fluid" controls></video>
                                        <div class="col-12 mt-10">
                                            <input type="file" name="content[{{$content->id}}][video]">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    @csrf
                    <input type="submit" class="btn btn-primary m-30" value="Update">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('a-asset/js/plugins/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('a-asset/js/plugins/dropzone.min.js')}}"></script>
    <script>
        jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each((index, element) => {
            jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
        });
        jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
            let el = jQuery(element);
            el.addClass('js-summernote-enabled').summernote({
                height: el.data('height') || 350,
                minHeight: el.data('min-height') || null,
                maxHeight: el.data('max-height') || null,
                backgroundColor: 'black'
               // Set the background color here

            });
        });
        @foreach($contents as $content)
            @if($content->primary_image != null || $content->secondary_image != null)
             // Dropzone.autoDiscover = false;
        {{"Dropzone.options.primaryImage".$content->id}} = {
            paramName: "primary_image",
            url: "{{route('admin.content.updatePrimaryImage', $content->id)}}",
            dictDefaultMessage: "<img src='{{asset($content->primary_image)}}' class='img-fluid'/>",
            maxFiles: 1,
            acceptedFiles: 'image/*',
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '205px', height: '90px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
                this.on('sending', function(data, xhr, formData){
                    formData.append('_token', '{{@csrf_token()}}');
                });
            }
        };
        @endif
        @endforeach

        @foreach($contents as $content)
            @if($content->secondary_image != null)
             // Dropzone.autoDiscover = false;
        {{"Dropzone.options.secondaryImage".$content->id}} = {
            paramName: "secondary_image",
            url: "{{route('admin.content.updatePrimaryImage', $content->id)}}",
            dictDefaultMessage: "<img src='{{asset($content->secondary_image)}}' class='img-fluid'/>",
            maxFiles: 1,
            acceptedFiles: 'image/*',
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '205px', height: '90px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
                this.on('sending', function(data, xhr, formData){
                    formData.append('_token', '{{@csrf_token()}}');
                });
            }
        };
        @endif
        @endforeach
    </script>
@endsection
