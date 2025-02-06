@extends('layouts.admin.app')
@section('title','User Management')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Users Management</h2>
    <div class="block">
        <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered  As</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $key => $user)
                <tr>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ $user->accountType() }}</td>
                    <td class="d-none d-sm-table-cell">
                            @if(($user->is_active == 1))
                            <span class="badge badge-success p-2">Approved</span>
                            @else
                            <span class="badge badge-danger p-2">Blocked</span>
                            @endif
                        </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit User">
                                <i class="fa fa-pencil text-primary"></i>
                            </a>
                            <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this User?') == true) document.getElementById('delete-'+{{$user->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete User">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </div>
                        <form id="delete-{{$user->id}}" action="{{ route('admin.user.destroy',  $user->id) }}" style="display:none" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
                    </td>
                </tr>
             
                @empty
                <tr>
                    <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No Registered User yet.</p></td>
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