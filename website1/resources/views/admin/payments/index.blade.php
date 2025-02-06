@extends('layouts.admin.app')
@section('title', 'Payments - Index')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Payment Transactions</h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-bordered text-center table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payer</th>
                        <th>Amount</th>
                        <th>Purpose</th>
                        <th>status</th>
                        <th>Action</th>
                        <th>Paid On</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($payments as $key => $payment)
                        <tr>
                            <td>#{{str_pad($payment->id, 5, '0', STR_PAD_LEFT)}}</td>
                            <!--<td>#{{$payment->id}}</td>-->
                            <td><a href="{{route('admin.account', $payment->user_id)}}">{{getUser($payment->user_id)->first_name.' '.getUser($payment->user_id)->last_name}}</a></td>
                            <td>${{number_format($payment->amount,2,".",".")}}</td>
                            <td>{{strtoupper(explode(':',$payment->purpose)[0])}}</td>
                            <td><button type="button" class="btn btn-rounded btn-noborder p-0 btn-success font-size-xs min-width-75 m-10">{{$payment->status}}</button></td>
                            <td>
                                <a href="{{$payment->receipt_url}}" target="_blank" title="view Stripe Receipt">
                                    <i class="fa fa-cc-stripe" style="font-size: 2em"></i>
                                </a>
                            </td>
                            <td>{{date('F j, Y, g:i a', strtotime($payment->created_at))}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Payment Received</td>
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
<script src="{{asset('a-asset/js/plugins/datatables.min.js')}}"></script>
@endsection
