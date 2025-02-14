@extends('layouts.admin.app')
@section('title', 'Edit Faqs '.$faqs_detail->id)
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
        <h2 class="content-heading">Editing Faqs # {{$faqs_detail->id}} <a href="{{route('admin.faqs.index')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <form method="POST" action="{{route('admin.faqs.update', $faqs_detail->id)}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                          

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating m-20">
                                        <textarea class="form-control" id="new" name="question" rows="8" value="{{(old('question'))?old('question'):$faqs_detail->question}}" >{{(old('question'))?old('question'):$faqs_detail->question}}</textarea>
                                        <label for="new">Faqs Question</label>
                                    </div>
                                </div>
                            </div>

                         
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating m-20">
                                        <textarea class="form-control" id="mw" name="answer" value="{{(old('answer'))?old('answer'):$faqs_detail->answer}}" rows="8">{{(old('answer'))?old('answer'):$faqs_detail->answer}}</textarea>
                                        <label for="mw">Faqs Answer</label>
                                    </div>
                                </div>
                            </div>

                         
                     
                        @if($errors->any())
                                <div class="text-danger">*{{$errors->first()}}</div>
                            @endif 

                            
                               <div class="form-group row text-center">
                                 <label class="col-12">Published</label>
                                    <div class="col-12">
                                       <label class="css-control css-control-success css-switch">
                                        <input type="checkbox" class="css-control-input" value="checked" name="is_active" {{($faqs_detail->is_active == 1)? 'checked': ''}}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                                </div>
                            <div class="form-group row text-center">
                                 <div class="col-md-12">
                                    <button type="submit"  class="btn btn-primary m-30"  class="btn btn-lg">
                                
                                            <i class="fa fa-save mr-5"></i>
                                            @if(auth()->user()->hasRole('Administrator'))
                                                update Faqs
                                            @else
                                                update Faqs
                                            @endif
                                        </button>
                              </div>
                              </div>
                        
                    </div>
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="faqs_id" value="{{ $faqs_detail->id }}">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/select2.full.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/summernote-bs4.min.js')}}"></script>
<script>
  
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
