@extends('layouts.admin.app')
@section('title', 'Contact Inquiries')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Inquiry # {{ $inquiry->id }} <a href="{{url('panel/inquiries')}}" class="btn btn-alt-primary pull-right">Back</a></h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <tbody>
                        <tr>
                            <th>Full Name :</th>
                            <td>{{$inquiry->first_name}} {{$inquiry->last_name}} </td>
                        </tr>
                        <tr>
                            <th>Business :</th>
                            <td>{{$inquiry->business->name}}</td>
                        </tr>
                        <tr>
                            <th>User :</th>
                            <td>{{$inquiry->user->first_name}} {{$inquiry->user->last_name}}</td>
                        </tr>
                    
                        <tr>
                            <th>Email :</th>
                            <td>{{$inquiry->email}}</td>
                        </tr>
                        <tr>
                            <th>Description :</th>
                            <td>{{$inquiry->description}}</td>
                        </tr>
              
                       
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
