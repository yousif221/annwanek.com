@extends('layouts.admin.app')
@section('title', 'Business -'.$business_details->id)
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
        <h2 class="content-heading">Business #{{$business_details->id}} ({{$business_details->name}}) <a href="{{route('admin.business.index')}}" class="btn btn-alt-primary pull-right"><i class="fa fa-arrow-left"></i> BACK</a></h2>
        <div class="block">
            <div class="block-content">
                <div class="row">
<div class="col-3">
<img src="{{ asset($business_details->logo) }}"style="width:275px;height:275px; border: 2px solid #000;"onerror="this.onerror=null;this.src='<?= $business_details->logo ? $business_details->logo : 'https://placehold.co/250x250/fff/000' ?>';">

</div>
<div class="col-3">
<img src="{{ asset($business_details->business_image) }}"style="width:275px;height:275px; border: 2px solid #000;"onerror="this.onerror=null;this.src='<?= $business_details->business_image ? $business_details->business_image : 'https://placehold.co/250x250/fff/000' ?>';">

</div>
<div class="col-3">
<img src="{{ asset($business_details->menu_image) }}"style="width:275px;height:275px; border: 2px solid #000;"onerror="this.onerror=null;this.src='<?= $business_details->menu_image ? $business_details->menu_image : 'https://placehold.co/250x250/fff/000' ?>';">

</div>
<div class="col-3">
<img src="{{ asset($business_details->interior_image) }}"style="width:275px;height:275px; border: 2px solid #000;"onerror="this.onerror=null;this.src='<?= $business_details->interior_image ? $business_details->interior_image : 'https://placehold.co/250x250/fff/000' ?>';">

</div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <h4>{{ $business_details->name }}</h4>
                        @isset($business_details->category->name)
                            <h6><b>Category:</b> {{ $business_details->category->name }}</h6>
                            @endisset
                            <h6><b>Location:</b> {{ $business_details->map }}</h6>
                       
                            <h6><b>Short Description:</b></h6>
                            <div class="agram_bagram">
                                <?= html_entity_decode($business_details->short_description) ?>
                                
                            </div><br>
                    </div>
                 
                    <div class="col-md-5">
                        <div class="business_details mt-10">
                        <h6><b>Address:</b> {{$business_details->address }}</h6>
                        <h6><b>Phone Number:</b> {{$business_details->phone }}</h6>

                        

                        <h6><b>Start Time:</b> {{ \Carbon\Carbon::parse($business_details->start_time)->format('h:i A') }}</h6>
                        <h6><b>End Time:</b> {{ \Carbon\Carbon::parse($business_details->end_time)->format('h:i A') }}</h6>
                       @if(!empty($business_details->description))
                            <h6><b>Description:</b></h6>
                            <div class="agram_bagrams" style=" overflow: auto; ">
                                <?= html_entity_decode($business_details->description) ?>
                            </div><br>
                            @endif
                            @if(!empty($business_details->additionalinfo))
                            <h6><b>Additional Information:</b></h6>
                            <div class="agram_bagrams" style=" overflow: auto;">
                                <?= html_entity_decode($business_details->additionalinfo) ?>
                                
                            </div><br>
                            @endif
                        </div>
                   
                        
                    </div>
                    <div class="col-md-2">
                        <div class="business_details mt-10">
                        <h6><b>Email:</b> {{$business_details->email }}</h6>
                        <h6><b>Website Url:</b> {{$business_details->website }}</h6>

                        </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('js')
@endsection
