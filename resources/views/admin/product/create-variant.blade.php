@extends('layouts.admin.app')
@section('title', 'Add Product Variant')
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
        <h2 class="content-heading">Adding Product Variation<a href="{{route('admin.product.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.product.storeVariant',$product_details->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Product Variations</h3>
                        </div>
                        <div class="block-content block-content-full">
   <!-- Attribute Type Dropdown -->
                                <div class="form-group row">
                                <label class="col-12">Attribute</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="variant_type" name="variant_type" placeholder="Attribute Name" value="{{(old('variant_type'))}}">
                                    @if($errors->has('variant_type'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('variant_type') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12">Value</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="variant_value" name="variant_value" placeholder="Value" value="{{(old('variant_value'))}}">
                                    @if($errors->has('variant_value'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('variant_value') }}</div>
                                    @endif
                                </div>
                            </div>


                <!-- Weight Dropdown (Initially Hidden) -->
                <div class="form-group row" id="weight_select" style="display:none;">
                    <div class="col-md-6">
                        <label for="var_weight">Weight</label>
                        <select class="form-control" name="var_weight">
                            <option disabled="" selected="">Select Weight</option>
                            @foreach($weights as $weight)
                            <option value="{{ $weight->name }}" {{(old('var_weight') == $weight->name)? 'selected="selected"': ''}}>{{ $weight->name }} </option>
                            @endforeach
                        </select>
                        @if($errors->has('var_weight'))
                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('var_weight') }}</div>
                        @endif
                    </div>
                </div>
                        
                            <div class="form-group row">
                       
                                <div class="col-md-6">
                                    <label for="var_stock">Stock</label>
                                    <input type="text" class="form-control" id="var_stock" name="var_stock" placeholder="Variant Stock" value="{{old('var_stock')}}">
                                    @if($errors->has('var_stock'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('var_stock') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="var_sku">SKU</label>
                                    <input type="text" class="form-control" id="var_sku" name="var_sku" placeholder="Variant SKU" value="{{old('var_sku')}}">
                                    @if($errors->has('var_sku'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('var_sku') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="block block-rounded block-themed">
          
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                            
                                <div class="col-sm-12 col-xl-12 mb-0">
                                    <div class="block text-center">
                                        <button type="submit" id="submit_product" class="btn btn-lg">
                                            <i class="fa fa-save mr-5"></i>
                                            Save Variant
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
<script>
    document.getElementById('variant_type').addEventListener('change', function() {
        var variantType = this.value;
        var sizeSelect = document.getElementById('size_select');
        var weightSelect = document.getElementById('weight_select');

        if (variantType === 'size') {
            sizeSelect.style.display = 'block';
            weightSelect.style.display = 'none';
        } else if (variantType === 'weight') {
            sizeSelect.style.display = 'none';
            weightSelect.style.display = 'block';
        } else {
            sizeSelect.style.display = 'none';
            weightSelect.style.display = 'none';
        }
    });
</script>
@endsection
