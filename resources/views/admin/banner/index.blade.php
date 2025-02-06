@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('css')

@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Banners Management</h2>
        <div class="block">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Banners</h3>
                            </div>
                            <div class="block-content">
                                <table class="table table-vcenter table-striped">
                                    <thead>
                                    <tr>
                                        <!-- <th class="d-none d-sm-table-cell" style="width: 25%;">Image</th> -->
                                        <th>Page</th>
                                        <th class="text-center" style="width: 20%;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                    <tr>
                                        <!-- <td class="d-none d-sm-table-cell">
                                            <img src="{{asset($banner->image)}}" width="100%">
                                        </td> -->
                                        <td>{{$banner->page}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-secondary" href="{{route('admin.banners.edit', $banner->id)}}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
