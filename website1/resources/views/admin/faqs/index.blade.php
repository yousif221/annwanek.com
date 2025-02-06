@extends('layouts.admin.app')
@section('title', 'Blogs')
@section('css')
<link rel="stylesheet" href="{{asset('a-asset/css/plugins/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Faqs <a href="{{route('admin.faqs.create')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add new Faqs</a></h2>
        <div class="block">
            <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Status</th>
                        <!-- <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th> -->
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($faqs as $key => $faq)
                    <tr>
                        <td>#{{str_pad($key+1, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{$faq->question}}</td>
                        <td class="d-none d-sm-table-cell">
                            @if($faq->is_active == 0)
                            <span class="badge badge-danger">Draft</span>
                            @else
                            <span class="badge badge-success">Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                
                                @if(auth()->user()->hasRole('Administrator'))
                   
                                
                                @endif
                             
                                <a href="{{route('admin.faqs.edit', $faq->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Faq">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Faq?') == true) document.getElementById('delete-'+{{$faq->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete faq">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                        <form id="delete-{{$faq->id}}" action="{{ route('admin.faqs.destroy',  $faq->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
                    </tr>
                
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Blogs yet.</p></td>
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
