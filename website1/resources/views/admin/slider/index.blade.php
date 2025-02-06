@extends('layouts.admin.app')
@section('title', 'Property Slider Index')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">

@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Home Page Banner Property Slider</h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Heading</th>
                        <th>Image</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sliders as $key => $slider)
                    <tr>
                        <td>#{{str_pad($slider->id, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{$slider->page}}</td>
                        <td>
                            <img src="{{asset($slider->primary_image)}}" width="20%">
                        </td>
                
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('admin.slider.edit', $slider->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Slider Info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Slider?') == true) document.getElementById('delete-'+{{$slider->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Slider">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-{{$slider->id}}" action="{{ route('admin.slider.destroy',  $slider->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Slider yet.</p></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/dataTables.bootstrap4.min.js')}}"></script>


<script>
$(document).ready( function () {
  var table = $('.js-dataTable-full').DataTable({
    rowReorder: true,
    lengthMenu:[[10,25,50,-1],[10,25,50,"All"]]
  });
  

  

  
} );
</script>
@endsection