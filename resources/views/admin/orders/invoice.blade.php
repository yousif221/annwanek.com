<!DOCTYPE html>
<html>
<head>
    <title>Order # {{$order_detail->order_number}} || {{ getConfig('website_name') }}</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{ public_path($favicon) }}">
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:150px;
        padding:3px 4px 3px 3px;
    }
    .logo span{
        margin-left:145px;
        top:40px;
        /*background-color: black;*/
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .margin-50{
        margin-top: 50px;
    }
    .add-detail{
        height:130px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice # {{ $order_detail->order_number }}</h1>
</div>
<div class="add-detail mt-10 ">
    <div class="w-50 float-left mt-10">
<!--         <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#6</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">162695CDFS</span></p> -->
        <p class="m-0 pt-5 text-bold w-100">Order Date: <span class="gray-color">{{$order_detail->created_at->format('d-M-Y')}} </span></p>

    </div>
    <div class="w-50 float-left logo mt-10">
        <span><img src="{{public_path($logo) }}"></span>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Customer Details</th>
            <th class="w-50">Order Details</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    @if($customer_info == 'guest')
                    <p><b>Name:</b> Guest Profile</p>
                    @else
                    <p><b>Name:</b> {{$customer_info->first_name}} {{$customer_info->last_name}}</p>
                    <p><b>Email:</b> {{$customer_info->email}}</p>
                    <p><b>Contact:</b> {{$customer_info->contact}}</p>
                    @endif
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><b>Order#:</b> {{$order_detail->order_number}}</p>
                    <p><b>Item Quanity:</b> {{$order_detail->quantity}}</p>
                    @if($order_detail->payment_status != null)
                    <p><b>Payment Status:</b> {{ $order_detail->payment_status}}</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Billing Details</th>
            <!-- <th class="w-50">Shipping Details</th> -->
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><b>Name:</b> {{$order_detail->billing_first_name}} {{$order_detail->billing_last_name}}</p>
                    <p><b>Email:</b> {{$order_detail->billing_email}}</p>
                    <p><b>Address:</b> {{$order_detail->billing_address1}} , {{ $order_detail->billing_address2 }}</p>
                    <p><b>Contact:</b> {{$order_detail->billing_contact}}</p>
                    <p><b>Country:</b> {{$order_detail->billing_country}}</p>
                    <p><b>State:</b> {{$order_detail->billing_state}}</p>
                    <p><b>Zipcode:</b> {{$order_detail->billing_zipcode}}</p>
                </div>
            </td>
            <!-- <td>
                <div class="box-text">
                    <p><b>Name:</b> {{$order_detail->shipping_first_name}} {{$order_detail->shipping_last_name}}</p>
                    <p><b>Email:</b> {{$order_detail->shipping_email}}</p>
                    <p><b>Address:</b> {{$order_detail->shipping_address1}} , {{ $order_detail->shipping_address2 }}</p>
                    <p><b>Contact:</b> {{$order_detail->shipping_contact}}</p>
                    <p><b>Country:</b> {{$order_detail->shipping_country}}</p>
                    <p><b>State:</b> {{$order_detail->shipping_state}}</p>
                    <p><b>Zipcode:</b> {{$order_detail->shipping_zip}}</p>

                    <p><b>Sub Totol :</b> ${{$order_detail->subtotal}}</p>
                    <p><b>Total Amount :</b> ${{$order_detail->total}}</p>
                    <p><b>Quantity :</b> {{$order_detail->quantity}}</p>
                    <p><b>Payment Status :</b> {{$order_detail->payment_status}}</p> -->
                    <tr>
        <th class="w-50">Products Attributes</th>
    </tr>

    @foreach($order_details as $order_detailed)
        <tr>
            <td>
                <div class="box-text">
                    @php
                        // Decode the JSON attribute data stored in order_item
                        $attributes = json_decode($order_detailed->attributes, true) ?: [];
                    @endphp
                <p><b>Product Name</b>{{$order_detailed->name}}</p>
                    @foreach($attributes as $attributeId)
                        @php
                            // Fetch the ProductVariant based on the attribute ID
                            $variant = App\ProductVariant::find($attributeId);
                        @endphp

                        @if($variant)
                            <p><b>{{ ucfirst($variant->attribute_type) }}:</b> {{ $variant->attribute_value }}</p>
                        @else
                            <p><b>Unknown Attribute:</b> No value found</p>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>
    @endforeach
                </div>
            </td> 
        </tr>
    </table>
</div>
<!-- <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>Free Shipping - Free Shipping</td>
        </tr>
    </table>
</div> -->
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Product Name</th>
            <th class="w-50">SKU</th>
           
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Subtotal</th>
            <!-- <th class="w-50">Total Amount</th> -->
        </tr>

        @foreach($order_details as $index => $details)
        <tr align="center">
            <td>{{$details->name}}</td>
            <td>{{$details->sku}}</td>
            <td>${{$details->price}}</td>
            <td>{{$details->size??'-'}}</td>
            
            <td>${{$details->price * $details->quantity}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub-Total</p>
                        <!-- <p>Discount</p> -->
                        <p>Total</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">   
                        <p>${{$order_detail->subtotal}} </p>
                        <!-- <p>${{$order_detail->subtotal-$order_detail->Total}} </p> -->
                        <p>${{$order_detail->Total}} </p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>