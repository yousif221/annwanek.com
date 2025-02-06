@extends('layouts.admin.app')
@section('title', 'Product -'.$product_details->id)
@section('css')
<style type="text/css">
    ul.product_tags {
        justify-content: start;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
    }
    ul.product_tags li {
        margin-right: 20px;
        border: 1px solid #001374;
        padding: 2px 6px;
        background: #6e80db;
        color: #fff;
    }
    ul.product_tags span {
        margin-right: 10px;
    }
  
    .agram_bagrams{
     
        height:300px;
        border: 1px solid;
        border-color: black;
        text-align: center;
    }
</style>
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Product #{{$product_details->id}} ({{$product_details->name}}) <a href="{{route('admin.product.index')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-arrow-left"></i> BACK</a></h2>
        <div class="block">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ asset($product_details->image) }}"style="width:275px;height:275px;"onerror="this.onerror=null;this.src='<?= $product_details->image ? $product_details->image : 'https://placehold.co/250x250/fff/000' ?>';">
                        <h4>{{ $product_details->name }}</h4>
                        @isset($product_details->category->name)
                            <h6><b>Category:</b> {{ $product_details->category->name }}</h6>
                            @endisset
                            <p><b>Stock:</b> {{ $product_details->stock }}</p>
                            @php 
                                   $bedsData = explode('||', $product_details->product_tags);


                       @endphp  
                          <p><b>Product tags:</b> 
                        @foreach($bedsData as $beds)
                                <tg>{{$beds}},</tg>
                                    @endforeach
                         </p>
                            <p><b>SKU:</b> {{ $product_details->sku }}</p>
                            <h6><b>Short Description:</b></h6>
                            <div class="agram_bagram">
                                <?= html_entity_decode($product_details->short_description) ?>
                                
                            </div><br>
                    </div>
                 
                    <div class="col-md-5">
                        <div class="product_details">
                           
                        
                            @isset($product_details->subcategory->name)
                            <h6><b>Sub Category:</b> {{ $product_details->subcategory->name }}</h6>
                            @endisset
                            <h5><b>Selling Price:</b> ${{number_format( $product_details->selling_price,2) }}</h5>
                             <h5><b>Actual Price:</b> ${{number_format($product_details->old_price,2) }}</h5>
                       
                  
                            
                         
                       @if(!empty($product_details->description))
                            <h6><b>Description:</b></h6>
                            <div class="agram_bagrams" style=" overflow: auto; ">
                                <?= html_entity_decode($product_details->description) ?>
                                
                            </div><br>
                            @endif
                            @if(!empty($product_details->additionalinfo))
                            <h6><b>Additional Information:</b></h6>
                            <div class="agram_bagrams" style=" overflow: auto;">
                                <?= html_entity_decode($product_details->additionalinfo) ?>
                                
                            </div><br>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('js')
@endsection
