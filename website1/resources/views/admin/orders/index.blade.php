@extends('layouts.admin.app')
@section('title', 'Orders')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Order Inquiries</h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Submitted On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $key => $order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->billing_first_name}} {{$order->billing_last_name}} </td>
                            <td>{{$order->billing_email}}</td>
                            <td>{{date('F j, Y, g:i a', strtotime($order->created_at))}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{url('panel/Orders', $order->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View orders">
                                        <i class="fa fa-eye text-primary"></i>
                                    </a>
                                    <a href="{{url('panel/Orders/invoice', $order->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View orders">
                                    <i class="fa fa-file text-danger"></i>
                                    </a>
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this orders?') == true) document.getElementById('delete-'+{{$order->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete orders">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                            <form id="delete-{{$order->id}}" action="{{ url('panel/Orders/delete',  $order->id) }}" style="display:none" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                        </tr>
                      
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No Contact orders Received.</p></td>
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