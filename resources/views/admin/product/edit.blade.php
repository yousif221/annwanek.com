@extends('layouts.admin.app')
@section('title', 'Updating Product - '.$product->name)
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
        a.deleteimage {
    float: left;
}
    </style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Product #{{$product->id}} ({{$product->name}}) <a href="{{route('admin.product.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <form method="post" action="{{route('admin.product.update', $product->id)}}" enctype="multipart/form-data">
            <div class="row gutters-tiny">
                <div class="col-md-7">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Product Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{(old('name'))?old('name'):$product->name}}">
                                    @if($errors->has('name'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="slug">Handle</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Product slug" value="{{(old('slug'))?old('slug'):$product->slug}}">
                                    @if($errors->has('slug'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('slug') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-12" for="slug">Type</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="type" name="type" placeholder="Product type" value="{{(old('type'))?old('type'):$product->type}}">
                                    @if($errors->has('type'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('type') }}</div>
                                    @endif
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-12">Short Description</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="short_description" placeholder="Short-Text description about Product" rows="14">{{(old('short_description'))?old('short_description'):html_entity_decode($product->short_description)}}</textarea>
                                    @if($errors->has('short_description'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="block-content block-content-full p-0">
                                        <label>Product Description</label>
                                        <textarea name="description" class="js-summernote">{{(old('description'))?old('description'):html_entity_decode($product->description)}}</textarea>
                                        @if($errors->has('description'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="block-content block-content-full p-0">
                                        <label>Product Description</label>
                                        <textarea name="detail" class="js-summernote">{{(old('detail'))?old('detail'):html_entity_decode($product->detail)}}</textarea>
                                        @if($errors->has('detail'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('detail') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="block-content block-content-full p-0">
                                        <label>Additional Information</label>
                                        <textarea name="additionalinfo" class="js-summernote">{{(old('additionalinfo'))?old('additionalinfo'):html_entity_decode($product->additionalinfo)}}</textarea>
                                        @if($errors->has('additionalinfo'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('additionalinfo') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                       
                   

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Featured Image</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                <img onerror="this.onerror=null;this.src='<?= $product->image ? $product->image : 'https://placehold.co/250x250/fff/000' ?>';" src="{{asset($product->image)}}" class="img-fluid m-auto p-20" style="max-height: 200px;">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="featured_image" data-toggle="custom-file-input">
                                        <label class="custom-file-label">Change Product's Featured Image</label>
                                    </div>
                                    @if($errors->has('featured_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('featured_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Gallery Images</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny items-push">
                                @forelse($product_images as $image)
                                <div class="form-group row">
                                    <div class="col-sm-4 col-xl-12">
                                
                            <a class="deleteimage"  href="{{route('admin.deleteimage',$image['id'])}}">X</a>

                     
                                        <img src="{{asset($image->image)}}" class="img-fluid m-auto p-20" style="max-height: 140px;">
                                    </div>
                                </div>
                                @empty
                              
                                @endforelse
                                <div class="col-sm-12 col-xl-12">
                                    <div class="block">
                                        <input type="file" class="custom-file-input" accept="image/*" name="multi_image[]" data-toggle="custom-file-input" multiple>
                                        <label class="custom-file-label">Change Product's Gallery Image</label>
                                        <small><b>* Choose multiple images</b></small>
                                    </div>
                                    @if($errors->has('multi_image'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('multi_image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Product Belonging</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12" for="categories">Category</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control" id="categories" name="category" style="width: 100%;" data-placeholder="Choose Product Category">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option {{ ($product->category_id == $category->id)? 'selected="selected"': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('category') }}</div>
                                    @endif
                                </div>
                            </div>

                        
                            <!-- <div class="form-group row">
                                <label class="col-12" for="product_tags">Tags</label>
                                @php $product_tags = explode("||",$product->product_tags) @endphp
                                <div class="col-12">
                                    <select class="js-select2 form-control product_tags" id="product_tags" name="tags[]" style="width: 100%;" data-placeholder="Product Tags" multiple="multiple">
                                        @foreach($product_tags as $tag)
                                        <option value="{{ $tag }}" selected="">{{ $tag }}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('tags'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('tags') }}</div>
                                    @endif
                                </div>
                            </div> -->
                        </div>
                    </div>
                  
                    @method('PUT')
                    <div class="block block-rounded block-themed">
                    <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Price and Stock</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>
                                        Product Selling Price
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-fw fa-usd"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{(old('selling_price'))?old('selling_price'):($product->selling_price)
                                    }}" name="selling_price" placeholder="Product Selling Price">
                                    </div>
                                    @if($errors->has('selling_price'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('selling_price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>
                                        Product Old Price
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-fw fa-usd"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{(old('old_price'))?old('old_price'):($product->actual_price)
                                    }}" name="old_price" placeholder="Product Old Price">
                                    </div>
                                    @if($errors->has('old_price'))
                                        <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('old_price') }}</div>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Stock</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-fw fa-archive"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" name="stock" value="{{(old('stock'))?old('stock'):$product->stock}}"  placeholder="0">
                                        </div>
                                        @if($errors->has('stock'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('stock') }}</div>
                                        @endif
                                </div>
                            </div>
                            @if(auth()->user()->hasRole('Administrator'))
                            <div class="form-group row text-center">
                                <label class="col-12">Published</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($product->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <label class="col-12">Review Able</label>
                                <div class="col-12">
                                    <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_reviewable" {{($product->is_reviewable == 1)? 'checked': ''}}>
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
                                                update Product
                                            @else
                                                update Product
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
@endsection
