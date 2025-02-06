@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('before-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
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
        .col-md-6.col-lg-4.col-xl-3.animated.fadeIn{
            padding: 10px 7px !important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Gallery Management <a href="{{route('admin.gallery.create')}}" class="btn btn-alt-primary pull-right">Add New Image</a></h2>
        <div class="row gutters-tiny">
        @foreach($gallery_images as $image)
        <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
            <div class="options-container fx-item-zoom-in fx-overlay-slide-down">
                <img class="img-fluid options-item" src="{{ asset($image->primary_image) }}"style="width:287px;height:227px;" alt="">
                <div class="options-overlay bg-black-op-75">
                    <div class="options-overlay-content">
                        <a class="btn btn-sm btn-rounded btn-noborder btn-alt-success min-width-65" href="{{route('admin.gallery.edit', $image->id)}}" data-toggle="tooltip" title="Edit Image"><i class="fa fa-pencil"></i> </a>

                        <a class="btn btn-sm btn-rounded btn-noborder btn-alt-danger min-width-65" href="javascript:;" onclick="if(confirm('Are you sure about deleting this Image?') == true) document.getElementById('delete-'+{{$image->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Image">
                                    <i class="fa fa-trash text-danger"></i> 
                                </a>
                        <!-- <a class="btn btn-sm btn-rounded btn-noborder btn-alt-danger min-width-75" href="{{ url('panel/image/delete',$image->id) }}"><i class="fa fa-trash"></i> Delete</a> -->
                    </div>
                </div>
            </div>
        </div>
        <form id="delete-{{$image->id}}" action="{{ route('admin.gallery.destroy',  $image->id) }}" style="display:none" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
        @endforeach
    </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    Dropzone.options.dropzone =
    {
        maxFilesize: 10,
        renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 60000,
        init: function() {
            this.on("thumbnail", function(file, dataUrl) {
                $('.dz-image').last().find('img').attr({width: '205px', height: '90px'});
            });
            this.on("maxfilesexceeded", function(file){
                // this.removeFile(file);
                alert("No more files please!");
            });
            this.on('sending', function(data, xhr, formData){
                formData.append('_token', '{{@csrf_token()}}');
            });
        }
    };
</script>
@endsection