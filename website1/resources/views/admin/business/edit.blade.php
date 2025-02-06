@extends('layouts.admin.app')
@section('title', 'Updating Business - '.$business->name)
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
        #submit_business {
            border: 1px solid #3e4d5f;
            background-color: #f0f2f5;
            color: #374659;
        }
        a.btn.btn-alt-primary.change_padding{
            padding: 11px 15px;
            border: 1px solid #125a96;
        }
        a.deleteimage {
    float: left;
}
    </style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Business #{{$business->id}} ({{$business->name}}) <a href="{{route('admin.business.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.business.update', $business->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                        @if(auth()->user()->hasRole('Administrator'))

                        <div class="form-group row">
                                <label class="col-12" for="user">User</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control" id="user" name="user" style="width: 100%;" data-placeholder="Choose User">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option {{ ($business->user_id == $user->id)? 'selected="selected"': ''}} value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('user'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('user') }}</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-12">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Business Name" value="{{(old('name'))?old('name'):$business->name}}">
                                    @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
    <label class="col-12" for="product_tags">Tags</label>
    @php 
        // Split the business tags by "||"
        $product_tags = explode("||", $business->business_tags); 
    @endphp
    <div class="col-12">
        <!-- Select input for tags -->
        <select class="js-select2 form-control business_tags" id="product_tags" name="tags[]" style="width: 100%;" data-placeholder="Product Tags" multiple="multiple">
            <!-- Loop through each tag and display it as an option -->
            @foreach($product_tags as $tag)
                <option value="{{ trim($tag) }}" 
                        @if(in_array(trim($tag), old('tags', $product_tags))) selected @endif>
                    {{ trim($tag) }}
                </option>
            @endforeach
        </select>
        @if($errors->has('tags'))
            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('tags') }}</div>
        @endif
    </div>
</div>


                            <div class="form-group row">
                                <label class="col-12" for="slug">Handle</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Business slug" value="{{(old('slug'))?old('slug'):$business->slug}}">
                                    @if($errors->has('slug'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('slug') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12">City</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="town" name="town" placeholder="Business town" value="{{(old('town'))?old('town'):$business->town}}">
                                    @if($errors->has('town'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('town') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12" for="slug">Website</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="website" name="website" placeholder="Business website" value="{{(old('website'))?old('website'):$business->website}}">
                                    @if($errors->has('website'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('website') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">Map Location Url</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="map" name="map" placeholder="Business map" value="{{(old('map'))?old('map'):$business->map}}">
                                    @if($errors->has('map'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('map') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">Start time</label>
                                <div class="col-12">
                                    <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Business start time" value="{{(old('start_time'))?old('start_time'):$business->start_time}}">
                                    @if($errors->has('start_time'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('start_time') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">End time</label>
                                <div class="col-12">
                                    <input type="time" class="form-control" id="end_time" name="end_time" placeholder="Business end time" value="{{(old('end_time'))?old('end_time'):$business->end_time}}">
                                    @if($errors->has('end_time'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('end_time') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">Address</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Business Address" value="{{(old('address'))?old('address'):$business->address}}">
                                    @if($errors->has('address'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">Email</label>
                                <div class="col-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Business email" value="{{(old('email'))?old('email'):$business->email}}">
                                    @if($errors->has('email'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="map">Phone Number</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Business phone number" value="{{(old('phone'))?old('phone'):$business->phone}}">
                                    @if($errors->has('phone'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <label class="col-12">Short Description</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="short_description" placeholder="Short-Text description about business" rows="14">{{(old('short_description'))?old('short_description'):html_entity_decode($business->short_description)}}</textarea>
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
                            <h3 class="block-title">Logo</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <img onerror="this.onerror=null;this.src='<?= $business->logo ? $business->logo : 'https://placehold.co/250x250/fff/000' ?>';" src="{{asset($business->logo)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="logo" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change business's Featured Image</label>
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
                                <img onerror="this.onerror=null;this.src='<?= $business->business_image ? $business->business_image : 'https://placehold.co/250x250/fff/000' ?>';" src="{{asset($business->business_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="business_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change business's Image</label>
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
                                <img onerror="this.onerror=null;this.src='<?= $business->menu_image ? $business->menu_image : 'https://placehold.co/250x250/fff/000' ?>';" src="{{asset($business->menu_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="menu_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change business's Menu Image</label>
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
                            <h3 class="block-title">Interior Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <img onerror="this.onerror=null;this.src='<?= $business->interior_image ? $business->interior_image : 'https://placehold.co/250x250/fff/000' ?>';" src="{{asset($business->interior_image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="interior_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change business's Featured Image</label>
                                    </div>
                                    @if($errors->has('interior_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('interior_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">business Belonging</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12" for="categories">Category</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control" id="categories" name="category" style="width: 100%;" data-placeholder="Choose business Category">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option {{ ($business->category_id == $category->id)? 'selected="selected"': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('category') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12" for="state">State</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control" id="state" name="state" style="width: 100%;" data-placeholder="Choose Business State">
                                        <option></option>
                                        @foreach($states as $state)
                                            <option {{ ($business->state_id == $state->id)? 'selected="selected"': ''}} value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('state'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('state') }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                  
                    @method('PUT')
                    <div class="block block-rounded block-themed">
                    <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Publish and Featured</h3>
                        </div>
                        <div class="block-content block-content-full">
                          
                            @if(auth()->user()->hasRole('Administrator'))
                            <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($business->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row text-center">
                            <label class="col-12">Feature</label>
                            <a style="height:50px;width: 50px;        margin-left: 216px;" href="{{route('admin.business.feature', $business->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($business->is_featured)? 'Unmark as Featured': 'Mark as Featured'}}">
                                    @if($business->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                                </label>
                                </div>
                            </div>
                            @endif
                            <div class="row gutters-tiny items-push">
                                <div class="col-sm-12 col-xl-12 mb-0">
                                    <div class="block text-center">
                                        <button type="submit" id="submit_business" class="btn btn-lg">
                                            <i class="fa fa-save mr-5"></i>
                                            @if(auth()->user()->hasRole('Administrator'))
                                                update business
                                            @else
                                                update business
                                            @endif
                                        </button><br><br><br><br>
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
    // $(".business_tags").select2({
    //     tags: true,
    //     tokenSeparators: [',', ' '],  // Allows space/comma separation for tags
    //     placeholder: "Enter product tags"
    // });

    // // Ensure that the '#' symbol is automatically added to each new tag typed manually
    // $(".business_tags").on('select2:open', function () {
    //     var $input = $(this).data('select2').$dropdown.find('input');

    //     // Handle input for adding tags and add # if not present
    //     $input.on('keyup', function(e) {
    //         let currentVal = $(this).val().trim();

    //         // Add '#' if the current value doesn't start with it
    //         if (currentVal && !currentVal.startsWith('#')) {
    //             $(this).val(`#${currentVal}`);  // Prepend the '#' symbol
    //         }
    //     });
    // });

    // // Detect manual input and prepend '#' if not present
    // $(".business_tags").on('input', function () {
    //     let currentVal = $(this).val().trim();

    //     // If the input text doesn't start with '#', prepend it
    //     if (currentVal && !currentVal.startsWith('#')) {
    //         $(this).val(`#${currentVal}`);
    //     }
    // });
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

<script>
    $(document).ready(function() {
        // Initialize Select2
        $(".business_tags").select2({
            tags: true,
            tokenSeparators: [',', ' '],  // Allows space/comma separation for tags
            placeholder: "Enter product tags"
        });

        // Detect when tags are selected from the dropdown or typed manually
        $(".business_tags").on('select2:select', function (e) {
            let selectedTag = e.params.data.text;
            // Prepend '#' if it doesn't already have it
            if (!selectedTag.startsWith('#')) {
                selectedTag = `#${selectedTag}`;
            }

            // Get current tags
            let currentTags = $(this).val();
            currentTags.push(selectedTag);

            // Update the Select2 value with the newly modified tag
            $(this).val(currentTags).trigger('change');
        });

        // Ensure that the '#' symbol is added while typing
        $(".business_tags").on('input', function () {
            let inputVal = $(this).val().trim();

            // Check if the input value starts with '#', otherwise prepend it
            if (inputVal && !inputVal.startsWith('#')) {
                $(this).val(`#${inputVal}`);
            }
        });

        // When Select2 is open, listen for user typing in the input field inside the dropdown
        $(".business_tags").on('select2:open', function () {
            let $input = $(this).data('select2').$dropdown.find('input');

            // Detect typing in the dropdown input field
            $input.on('keyup', function (e) {
                let currentVal = $(this).val().trim();
                // If it doesn't start with '#', prepend it
                if (currentVal && !currentVal.startsWith('#')) {
                    $(this).val(`#${currentVal}`);
                }
            });
        });
    });
</script>
@endsection
