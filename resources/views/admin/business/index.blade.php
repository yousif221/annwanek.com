@extends('layouts.admin.app')
@section('title', 'Business')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
<style>

</style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Businesses 
            <a href="{{route('addbussiness')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add new Business</a></h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>business</th>
                     
                
                        <th> Category</th>
                        <th>Status</th>
                        <!-- <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th> -->
                        <th class="text-center" style="width: 100px;">Actions</th>
                        <!-- <th> Variants</th> -->

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($businesses as $key => $product)
                    <tr>
                        <td>#{{str_pad($product->id, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{$product->name}}</td>
                       
                        @isset($product->category->name)
                        <td>{{$product->category->name}}</td>
                        @endisset
                        @isset($product->subcategory->name)
                        <td>{{$product->subcategory->name}}</td>
                        @endisset
                        <td class="d-none d-sm-table-cell">
                            @if($product->is_active == 0)
                            <span class="badge badge-danger">Draft</span>
                            @else
                            <span class="badge badge-success">Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                
                                @if(auth()->user()->hasRole('Administrator'))
                                <a href="{{route('admin.business.show', $product->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Product">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                                <a href="{{route('admin.business.feature', $product->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($product->is_featured)? 'Unmark as Featured': 'Mark as Featured'}}">
                                    @if($product->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                              
                               
                                @endif
                                <a href="{{route('admin.business.showvariant',$product->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Product">
                                 Add menu
                                </a>

                                <a href="{{route('admin.business.edit', $product->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Product">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                              
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Business?') == true) document.getElementById('delete-'+{{$product->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Product">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                            <form id="delete-{{$product->id}}" action="{{ route('admin.business.destroy',  $product->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
                        </td>
                        <!-- <td>
                        <div class="btn-group">
                        <a href="{{route('admin.business.showvariant', $product->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Product">
                       Add Variant
                                </a>

                        </div>
                        </td> -->
                    </tr>
                  
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Product yet.</p></td>
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
