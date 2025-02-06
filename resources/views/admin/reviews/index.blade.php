@extends('layouts.admin.app')
@section('title', 'Reviews')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Reviews Management</h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Business Name</th>
                        <th>Food</th>
                        <th>Service</th>
                        <th>Atmosphere</th>
                        <th>Value</th>

                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reviews as $key => $reviews)
                    <tr>
                        <td>{{$reviews->first_name}}</td>
                        <td>{{$reviews->email}}</td>
                 
                        <td>{{$reviews->business->name}}</td>
                 
                        <td>{{$reviews->food}}</td>
                        <td>{{$reviews->service}}</td>
                        <td>{{$reviews->atmosphere}}</td>
                        <td>{{$reviews->value}}</td>

                     
                        <td class="d-none d-sm-table-cell">
                            @if(($reviews->is_featured == 1))
                            <span class="badge badge-success p-2">Active</span>
                            @else
                            <span class="badge badge-danger p-2">Hidden</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                            <a href="{{route('admin.reviews.feature', $reviews->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($reviews->is_featured)? 'Unmark as Published': 'Mark as Published'}}">
                                    @if($reviews->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                                <a href="{{route('admin.reviews.edit', $reviews->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit reviews">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this reviews?') == true) document.getElementById('delete-'+{{$reviews->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete reviews">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-{{$reviews->id}}" action="{{ route('admin.reviews.destroy',  $reviews->id) }}" style="display:none" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    </tbody>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">No reviews Added Yet.</p></td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
