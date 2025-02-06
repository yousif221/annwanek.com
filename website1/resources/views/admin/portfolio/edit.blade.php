@extends('layouts.admin.app')
@section('title', 'Edit Portfolio '.$portfolio->id)
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/summernote-bs4.css')}}">
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Editing Portfolio # {{$portfolio->id}} <a href="{{route('admin.portfolio.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.portfolio.update', $portfolio->id)}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <input type="text" class="form-control" id="name" name="name" value="{{$portfolio->name}}">
                                        @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                        <label for="name"> Name</label>
                                    </div>
                                </div>
                            </div>
                          
                          
                            <div class="form-group row">
                            <div class="col-md-12">
                            <div class="block-content block-content-full p-0">
                            <label class="col-12" for="description">Description</label>

                                    <div class="col-12">
                                        <textarea class="js-summernote" id="description" name="description" style="height:300px;">{{$portfolio->description}}</textarea>
                                        </div>
                                        @if($errors->has('description'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('description') }}</div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                      
                        <div class="col-md-12 text-center">
                            <img src="{{asset($portfolio->image)}}" class="img-fluid pb-10">
                            <div class="block col-md-12">
                                <input type="file" class="custom-file-input" id="example-file-input-custom" name="primaryImage" data-toggle="custom-file-input">
                           
                                <label class="custom-file-label" for="example-file-input-custom">Choose Portfolio Image</label>
                            </div>
                        </div>
                           
                              <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                  <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($portfolio->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                             
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary m-30" value="Update Portfolio">
                            </div>
                            
                    </div>  </div>
                    @method('PUT')
                    @csrf
                </form>
            </div>
        </div>
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
            height: el.data('height') || 250,
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
        tokenSeparators: [',']
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
