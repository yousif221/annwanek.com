@extends('layouts.admin.app')
@section('title', 'Business')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Business Variants <a href="{{route('admin.business.createVariant',$business_details->id)}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add Menu Items</a>
            <a href="{{route('admin.business.index')}}" class="btn btn-alt-primary pull-right mr-5"><i class="fa fa-arrow-left"></i> Business Index</a>
        </h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Price</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($business_details->menuItems as $variant)
    
                        <tr>
                            <td>
                            @if($variant->name)
                                    {{ $variant->name }}
                                @else
                                    No Menu Item
                                @endif
                            </td>

                            <td>
                            @if($variant->price)
                                  ${{ $variant->price }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if(auth()->user()->hasRole('Administrator'))
                                        <!-- Add additional buttons for admins if needed -->
                                    @endif
                                    <a href="{{route('admin.business.editVariant', $variant->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Variant">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this variant?') == true) document.getElementById('delete-'+{{$variant->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Variant">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-{{$variant->id}}" action="{{ route('admin.business.destroyvariant',  $variant->id) }}" style="display:none" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Menu item yet.</p></td>
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
