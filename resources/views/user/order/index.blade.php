@extends('layouts.admin.app')
@section('title', 'Orders')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Orders Management</h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>Order #</th>
                   
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                  
                        <td>{{ $order->created_at->format('d-M-Y') }}</td>
                        @if($order->order_status == 0)
                        <td><span class="badge badge-danger p-2">Pending</span></td>
                        @elseif($order->order_status == 1)
                        <td><span class="badge badge-success p-2" >Dispatched</span></td>
                        @elseif($order->order_status == 2)
                        <td><span class="badge badge-success p-2" >Delivered</span></td>
                        @elseif($order->order_status == 3)
                        <td><span class="badge badge-success p-2" >Ariving </span></td>
                        @elseif($order->order_status == 4)
                        <td><span class="badge badge-danger p-2" >Canceled </span></td>
                        @endif
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{url('user/order/invoice', $order->id)}}" target="_blank" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Order Invoice">
                                    <i class="fa fa-file text-info"></i>
                                </a>
                                <a href="{{ url('user/order', $order->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Order Details">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Boat yet.</p></td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
