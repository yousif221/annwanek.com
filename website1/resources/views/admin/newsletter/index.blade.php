@extends('layouts.admin.app')
@section('title', 'Newsletter Subscriptions')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Newsletter Subscriptions</h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Subscribed On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subscriptions as $key => $subscription)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$subscription->newsletter_email}}</td>
                            <td>{{date('F j, Y, g:i a', strtotime($subscription->created_at))}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this newsletter Inquiry?') == true) document.getElementById('delete-'+{{$subscription->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Newsletter Inquiry">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                            <form id="delete-{{$subscription->id}}" action="{{ url('panel/newsletter',  $subscription->id) }}" style="display:none" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
            </form>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No Subscribers Yet.</p></td>
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
