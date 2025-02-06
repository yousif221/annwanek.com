@extends('layouts.admin.app')
@section('title', 'Contact Inquiries')
@section('css')
<style>
    .table td, .table th {
    padding: 10px !important;
    
}
.table {

}
.block {
    width: 70%;
}
</style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Book NowInquiry # {{ $inquiry->id }} <a href="{{url('panel/book-now-inquiries')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <tbody>
                        <tr>
                            <th>Name :</th>
                            <td>{{$inquiry->first_name}} </td>
                        </tr>
                   
                        @if($inquiry->contact !=null)
                        <tr>
                            <th>Phone Number  :</th>
                            <td>{{$inquiry->contact}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Email :</th>
                            <td>{{$inquiry->email}}</td>
                        </tr>
                        <tr>
                            <th>Date :</th>
                            <td>{{$inquiry->date}}</td>
                        </tr>
                        <tr>
                            <th>Service :</th>
                            <td>{{$inquiry->service->title}}</td>
                        </tr>
                        @if($inquiry->package_id !=null)
                        <tr>
                            <th>Package  :</th>
                            <td>{{$inquiry->package->name}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Time :</th>
                            <td>{{ \Carbon\Carbon::parse($inquiry->time)->format('h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Message :</th>
                            <td>{{$inquiry->message}}</td>
                        </tr>
                      

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
