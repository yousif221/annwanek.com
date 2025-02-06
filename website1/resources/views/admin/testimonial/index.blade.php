@extends('layouts.admin.app')
@section('title', 'Testimonials')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Testimonials Management <a href="{{route('admin.testimonial.create')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add New Testimonial</a></h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>Name</th>
                       
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($testimonials as $key => $testimonial)
                    <tr>
                        <td>{{$testimonial->name??'-'}}</td>
                       
                        <td class="d-none d-sm-table-cell">
                            @if(($testimonial->is_active == 1))
                            <span class="badge badge-success p-2">Active</span>
                            @else
                            <span class="badge badge-danger p-2">Hidden</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('admin.testimonial.edit', $testimonial->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Testimonial">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="{{route('admin.testimonial.feature', $testimonial->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($testimonial->is_featured)? 'Unmark as Featured': 'Mark as Featured'}}">
                                    @if($testimonial->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Testimonial?') == true) document.getElementById('delete-'+{{$testimonial->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Testimonial">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                        <form id="delete-{{$testimonial->id}}" action="{{ route('admin.testimonial.destroy',  $testimonial->id) }}" style="display:none" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    </tr>
                    <form id="delete-{{$testimonial->id}}" action="{{ route('admin.testimonial.destroy',  $testimonial->id) }}" style="display:none" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    </tbody>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No Testimonial Added Yet.</p></td>
                    </tr>
                    @endforelse
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
