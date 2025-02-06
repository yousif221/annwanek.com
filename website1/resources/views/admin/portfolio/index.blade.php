@extends('layouts.admin.app')
@section('title', 'Portfolio')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Portfolio Management <a href="{{route('admin.portfolio.create')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add New Portfolio</a></h2>
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
                    @forelse($portfolios as $key => $portfolio)
                    <tr>
                        <td>{{$portfolio->name}}</td>
                       
                        <td class="d-none d-sm-table-cell">
                            @if(($portfolio->is_active == 1))
                            <span class="badge badge-success p-2">Active</span>
                            @else
                            <span class="badge badge-danger p-2">Hidden</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('admin.portfolio.edit', $portfolio->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Portfolio">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Portfolio?') == true) document.getElementById('delete-'+{{$portfolio->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Portfolio">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                        <form id="delete-{{$portfolio->id}}" action="{{ route('admin.portfolio.destroy',  $portfolio->id) }}" style="display:none" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    </tr>
                    <form id="delete-{{$portfolio->id}}" action="{{ route('admin.portfolio.destroy',  $portfolio->id) }}" style="display:none" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    </tbody>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No Portfolio Added Yet.</p></td>
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
