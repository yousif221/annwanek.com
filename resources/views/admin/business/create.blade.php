@extends('layouts.admin.app')
@section('title', 'Add Business')
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
    </style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Adding new Business<a href="{{route('admin.business.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.business.store')}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                            @if($errors->any())
                            @foreach($errors as $message)
                            {{ $message }}
                            @endforeach
                            @endif
                            <div class="form-group row">
                                <label class="col-12">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Business Name" value="{{old('name')}}">
                                    @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="slug">Slug</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Business slug" value="{{old('slug')}}">
                                    @if($errors->has('slug'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('slug') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="type">Website</label>
                                <div class="col-12">
                                    <input type="url" class="form-control" id="website" name="website" placeholder="Business website" value="{{old('website')}}">
                                    @if($errors->has('website'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('website') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="type">map</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="map" name="map" placeholder="map" value="{{old('map')}}">
                                    @if($errors->has('map'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('map') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Start time</label>
                                <div class="col-12">
                                    <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                                    @if($errors->has('start_time'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('start_time') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">End time</label>
                                <div class="col-12">
                                    <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                                    @if($errors->has('end_time'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('end_time') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Address</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
                                    @if($errors->has('address'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Email</label>
                                <div class="col-12">
                                    <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Phone Number</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                                    @if($errors->has('phone'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12">Short Description</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="short_description" placeholder="Short-Text description about Business" rows="8">{{ old('short_description') }}</textarea>
                                    @if($errors->has('short_description'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-md-5">
                <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business logo</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="logo" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Choose Business's Logo Image</label>
                                    </div>
                                    @if($errors->has('logo'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('logo') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="business_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Choose Business's  Image</label>
                                    </div>
                                    @if($errors->has('business_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('business_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Menu Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="menu_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Choose Business's Menu Image</label>
                                    </div>
                                    @if($errors->has('menu_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('menu_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Interior Image </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="interior_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Choose Interior's Image</label>
                                    </div>
                                    @if($errors->has('interior_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('interior_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Gallery Images</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="multi_image[]" data-toggle="custom-file-input" multiple>
                                        <label class="custom-file-label">Choose Product's Gallery Image</label>
                                        <small><b>* Choose multiple images</b></small>
                                    </div>
                                    @if($errors->has('multi_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('multi_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business Belonging</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12" for="categories">Category</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control" id="categories" name="category" style="width: 100%;" data-placeholder="Choose Product Category">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option {{(old('category') == $category->id)? 'selected="selected"': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('category') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="block block-rounded block-themed">
                
                  
                    <div class="block block-rounded block-themed">
             
                        <div class="block-content block-content-full">
                          
                     
                      
                            @if(auth()->user()->hasRole('Administrator'))
                                <div class="form-group row text-center">
                                    <label class="col-12">Published</label>
                                    <div class="col-12">
                                        <label class="css-control css-control-success css-switch">
                                            <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{(old('is_active'))? (old('is_active') == 'checked')? 'checked': '':''}}>
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
                                                Save Bussiness & Continue
                                            @else
                                                Submit Bussiness & Continue
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
