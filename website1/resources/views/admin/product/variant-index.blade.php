@extends('layouts.admin.app')
@section('title', 'Products')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Product Variants <a href="{{route('admin.product.createVariant',$product_details->id)}}" class="btn btn-alt-primary pull-right"><i class="fa fa-plus-circle"></i> Add Product Variant</a>
            <a href="{{route('admin.product.index')}}" class="btn btn-alt-primary pull-right mr-5"><i class="fa fa-arrow-left"></i> Product Index</a>
        </h2>
        <div class="block">
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Attributes</th>
                        <th>Value</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($product_variations as $key => $variant)
                    <tr>
                      
                        <td>{{$variant->productvar->name}}</td>
                        @if($variant->attribute_type)
                        <td>{{$variant->attribute_type}}</td>
                        @endif
                        @if($variant->attribute_value)
                        <td>{{$variant->attribute_value}}</td>
                        @endif
                     
                        <td>{{$variant->var_sku}}</td>
                        <td>{{$variant->var_stock}} qty</td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if(auth()->user()->hasRole('Administrator'))
                                @endif
                                <a href="{{route('admin.product.editVariant', $variant->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Variant">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this variant?') == true) document.getElementById('delete-'+{{$variant->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Variant">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <form id="delete-{{$variant->id}}" action="{{ route('admin.product.destroyvariant',  $variant->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">You have not listed any Variant yet.</p></td>
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
