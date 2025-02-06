@extends('layouts.admin.app')
@section('title', 'Accounts Listing')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
    <main id="main-container">
        <div class="content">
            <h2 class="content-heading">Accounts Listing</h2>
            <div class="block">
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th>Account Type</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 15%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($accounts as $member)
                            <tr>
                                <td class="text-center">#{{str_pad($member->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td class="font-w600">{{$member->name()}}</td>
                                <td class="d-none d-sm-table-cell">{{$member->email}}</td>
                                <td class="d-none d-sm-table-cell">{{$member->accountType()}}</td>
                                <td class="d-none d-sm-table-cell">
                                    @if($member->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Disabled</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.account', $member->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Profile">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <p class="muted">Currently there are no active Users on the Platform.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
<script src="{{asset('a-asset/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('a-asset/js/plugins/datatables.min.js')}}"></script>
@endsection
