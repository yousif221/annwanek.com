@extends('layouts.admin.app')
@section('title', 'Blogs')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Blogs <a href="{{route('admin.blog.create')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add new Blogs</a></h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>State</th>
                        <th>Status</th>
                        <!-- <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th> -->
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($blogs as $key => $blog)
                    <tr>
                        <td>#{{str_pad($blog->id, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{$blog->title}}</td>
                        <td>{{$blog->state->name}}</td>
                        <td class="d-none d-sm-table-cell">
                            @if($blog->is_active == 0)
                            <span class="badge badge-danger">Draft</span>
                            @else
                            <span class="badge badge-success">Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                
                                @if(auth()->user()->hasRole('Administrator'))
                                <!-- <a href="{{route('admin.blog.show', $blog->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Product">
                                    <i class="fa fa-eye text-primary"></i>
                                </a> -->

                                
                                @endif
                                <a href="{{route('admin.blog.feature', $blog->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($blog->is_featured)? 'Unmark as Featured': 'Mark as Featured'}}">
                                    @if($blog->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                                <a href="{{route('admin.blog.edit', $blog->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Product">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Product?') == true) document.getElementById('delete-'+{{$blog->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Product">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-{{$blog->id}}" action="{{ route('admin.blog.destroy',  $blog->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
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
@endsection
