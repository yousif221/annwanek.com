@extends('layouts.admin.app')
@section('title', 'Edit Reviews '.$reviews_detail->id)
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
        <h2 class="content-heading">Editing Reviews # {{$reviews_detail->id}} <a href="{{route('admin.reviews.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.reviews.update', $reviews_detail->id)}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-md-12">
                                @if($errors->any())
                                <div class="text-danger">*{{$errors->first()}}</div>
                            @endif
                                    <div class="form-material form-material-primary floating m-20">
                                        <input type="text" class="form-control" name="name" value="{{(old('name'))?old('name'):$reviews_detail->first_name}}">
                                        @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                        <label> Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <label>Review Food</label>
                                        <select name="food" class="form-control" required="required">
                                            <option value="1" {{ ($reviews_detail->food == 1) ? 'selected' : '' }}>1 Star Rating</option>
                                            <option value="2" {{ ($reviews_detail->food == 2) ? 'selected' : '' }}>2 Star Rating</option>
                                            <option value="3" {{ ($reviews_detail->food == 3) ? 'selected' : '' }}>3 Star Rating</option>
                                            <option value="4" {{ ($reviews_detail->food == 4) ? 'selected' : '' }}>4 Star Rating</option>
                                            <option value="5" {{ ($reviews_detail->food == 5) ? 'selected' : '' }}>5 Star Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <label>Review Value</label>
                                        <select name="value" class="form-control" required="required">
                                            <option value="1" {{ ($reviews_detail->value == 1) ? 'selected' : '' }}>1 Star Rating</option>
                                            <option value="2" {{ ($reviews_detail->value== 2) ? 'selected' : '' }}>2 Star Rating</option>
                                            <option value="3" {{ ($reviews_detail->value== 3) ? 'selected' : '' }}>3 Star Rating</option>
                                            <option value="4" {{ ($reviews_detail->value== 4) ? 'selected' : '' }}>4 Star Rating</option>
                                            <option value="5" {{ ($reviews_detail->value== 5) ? 'selected' : '' }}>5 Star Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <label>Review Atmosphere</label>
                                        <select name="atmosphere" class="form-control" required="required">
                                            <option value="1" {{ ($reviews_detail->atmosphere == 1) ? 'selected' : '' }}>1 Star Rating</option>
                                            <option value="2" {{ ($reviews_detail->atmosphere == 2) ? 'selected' : '' }}>2 Star Rating</option>
                                            <option value="3" {{ ($reviews_detail->atmosphere== 3) ? 'selected' : '' }}>3 Star Rating</option>
                                            <option value="4" {{ ($reviews_detail->atmosphere== 4) ? 'selected' : '' }}>4 Star Rating</option>
                                            <option value="5" {{ ($reviews_detail->atmosphere == 5) ? 'selected' : '' }}>5 Star Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <label>Review Service</label>
                                        <select name="service" class="form-control" required="required">
                                            <option value="1" {{ ($reviews_detail->service== 1) ? 'selected' : '' }}>1 Star Rating</option>
                                            <option value="2" {{ ($reviews_detail->service == 2) ? 'selected' : '' }}>2 Star Rating</option>
                                            <option value="3" {{ ($reviews_detail->service== 3) ? 'selected' : '' }}>3 Star Rating</option>
                                            <option value="4" {{ ($reviews_detail->service== 4) ? 'selected' : '' }}>4 Star Rating</option>
                                            <option value="5" {{ ($reviews_detail->service == 5) ? 'selected' : '' }}>5 Star Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material form-material-primary floating m-20">
                                        <input type="text" class="form-control" name="inquiry_email" value="{{(old('inquiry_email'))?old('inquiry_email'):$reviews_detail->email}}">
                                        @if($errors->has('inquiry_email'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('inquiry_email') }}</div>
                                    @endif
                                        <label> Email</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">    
                                <div class="block-content block-content-full p-0">
                                <label>Review</label>
                                        
                                        <textarea class="js-summernote" name="review" rows="8">{{(old('review'))?old('review'):$reviews_detail->review}}</textarea>
                                        @if($errors->has('review'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('review') }}</div>
                                    @endif
                            
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                            <img src="{{asset($reviews_detail->image)}}" class="img-fluid pb-10">
                            <div class="block col-md-12">
                                <input type="file" class="custom-file-input" id="example-file-input-custom" name="primaryImage" data-toggle="custom-file-input">
                                <label class="custom-file-label" for="example-file-input-custom">Choose User Image</label>
                            </div>
                        </div>
                      
                            <div class="col-md-12 text-center">
                            <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_featured" {{($reviews_detail->is_featured == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            
                            <div class="col-md-12 text-center">
                            <div class="col-md-12">
                            <button type="submit"  class="btn btn-primary m-30"  class="btn btn-lg">
                                
                                            <i class="fa fa-save mr-5"></i>
                                            @if(auth()->user()->hasRole('Administrator'))
                                                update Reviews
                                            @else
                                                update Reviews
                                            @endif
                                        </button>
                            </div>
                          </div>
                        </div>
                    </div>
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="reviews_id" value="{{ $reviews_detail->id }}">
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
    $(".service_tags").select2({
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
