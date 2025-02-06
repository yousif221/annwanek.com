@extends('layouts.admin.app')
@section('title', 'Updating Product Variant'.$business_variant->id)
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
        <h2 class="content-heading">Updating Menu Items # {{$business_variant->id}}<a href="{{route('admin.business.showvariant',$business_variant->business_id)}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.business.updateVariant',$business_variant->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Business Variations</h3>
                        </div>
                        <div class="block-content block-content-full">


   <!-- Attribute Type Dropdown -->
   <div class="form-group row">
                                <label class="col-12">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Item Name" value="{{(old('name'))?old('name'):$business_variant->name}}">
                                    @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                <div class="form-group row">
                                <label class="col-12">Price</label>
                                <div class="col-12">business
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Value" value="{{(old('price'))?old('price'):$business_variant->price}}">
                                    @if($errors->has('price'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>

                       

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea type="text"  class="form-control" id="description" name="description" placeholder="description" >{{(old('description'))?old('description'):$business_variant->description}}
                             </textarea>
                                    @if($errors->has('description'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>

                        
   
                          <br>

                            <div class="col-sm-12 col-xl-12 mt-9">
                                <div class="block text-center">
                                    <button type="submit" id="submit_product" class="btn btn-lg">
                                        <i class="fa fa-save mr-5"></i>
                                        Save Menu Items
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                         
                        </div>
                    </div>
                </div>
            </div>
            @csrf
            @method('put')
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
<script>
    function toggleAttributeFields() {
        const attributeType = document.getElementById("variant_type").value;
        document.getElementById("size_field").style.display = attributeType === "size" ? "block" : "none";
        document.getElementById("weight_field").style.display = attributeType === "weight" ? "block" : "none";
    }
</script>
@endsection
