@extends('layouts.admin.app')
@section('title','Orders')
@section('css')
<style type="text/css">
#stepProgressBar  {
	display:  flex;
	justify-content:  space-between;
	align-items:  flex-end;
	width:  300px;
	margin:  0  auto;
	margin-bottom:  30px;
    list-style-type: none;
}

.step  {
text-align:  center;
}

.step-text  {
margin-bottom:  3px;
color:  #3f9ce8;
}
/* #stepProgressBar li{
    border-right: 1px solid #000;
    height: 70px;
} */

.bullet {
	border: 1px solid #3f9ce8;
	height: 20px;
	width: 20px;
	border-radius: 100%;
	color: #3f9ce8;
	display: inline-block;
	position: relative;
	transition: background-color 500ms;
    line-height:20px;
    /* background-color:#3f9ce8; */
}
li.active .bullet {
	border: 1px solid #3f9ce8;
	height: 20px;
	width: 20px;
	border-radius: 100%;
	color: #3f9ce8;
	display: inline-block;
	position: relative;
	transition: background-color 500ms;
    line-height:20px;
    background-color:#3f9ce8;
}

p.error-message {
        color: red;
        font-weight: 600;
    }

</style>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid bg-white mt-5 p-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                    <a href="{{url('/user/order/index')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right"> Back</a>
                    <div class="card-body">
                        <h3 class="box-title pull-left">Order # {{$order->order_number}}</h3>
                        {{-- <ul id="progressbar">
                            <li class="active"><span class="progress_span">Pending</span></li>
                            <li><span class="progress_span">Dispatched</span></li>
                            <li><span class="progress_span">Delivered</span></li>
                        </ul> --}}
                        <ul id="stepProgressBar">
                            <li class="step  {{ ($order->order_status == 0) ? 'active' : '' }}">
                                <p class="step-text"style="width: 105px;">Pending</p>
                                <div class="bullet"></div>
                            </li>
                            <hr width="100%" size="500">
                            <li class="step {{ ($order->order_status == 1) ? 'active' : '' }}">
                                <p class="step-text active"style="width: 105px;">Out for Delivery</p>
                                <div class="bullet"></div>
                            </li>
                            <hr width="100%" size="500">
                            <li class="step {{ ($order->order_status == 2) ? 'active' : '' }}">
                                <p class="step-text active"style="width: 105px;">Delivered</p>
                                <div class="bullet"></div>
                            </li>
                            <hr width="100%" size="500">
                            <li class="step {{ ($order->order_status == 3) ? 'active' : '' }}">
                                <p class="step-text active"style="width: 105px;">Ariving ({{$order->ariving_time }})</p>
                                <div class="bullet"></div>
                            </li>
                            <hr width="100%" size="500">
                            <li class="step {{ ($order->order_status == 4) ? 'active' : '' }}">
                                <p class="step-text active"style="width: 105px;">Cancelled</p>
                                <div class="bullet"></div>
                            </li>
                        </ul>
                        
                        </div>
                        
                        <div class="clearfix"></div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Customer Information:</h2>

                                <label for="firstname"><b>Customer Name :</b></label>
                                <span id="firstname">{{ $customer->first_name }} {{ $customer->last_name }}</span><br>

                                <label for="useremail"><b>Email :</b></label>
                                <span id="useremail">{{ $customer->email }}</span><br>

                                <label for="usercontact"><b>Contact :</b></label>
                                <span id="usercontact">{{ $customer->contact?? '-' }}</span>

                            </div>
                            <div class="col-md-4">
                                <h2>Billing Information:</h2>
                                <label for="firstname"><b>Address :</b></label>
                                <span id="firstname">{{ $order->billing_address1 }}, {{ $order->billing_address2 }}</span><br>

                                <label for="lastname"><b>Country :</b></label>
                                <span id="lastname">{{ $order->billing_country }}</span><br>

                                <label for="lastname"><b>State :</b></label>
                                <span id="lastname">{{ $order->billing_state }}</span><br>

                                <label for="lastname"><b>Zip Code :</b></label>
                                <span id="lastname">{{ $order->billing_zipcode }}</span><br>
                                <label for="lastname"><b>Billing Contact :</b></label>
                                <span id="lastname">{{ $order->billing_contact }}</span><br>
                            </div>
                

                          
                        </div>
                        <div class="row">
                        @foreach($orderitems as $key => $order_detailed)
    @php
        // Decode the JSON attribute data stored in order_item
        $attributes = json_decode($order_detailed->attributes, true) ?: [];
    @endphp

    <div class="col-md-12">
        <label><b>{{$key +1}} :Products Name:</b>{{$order_detailed->name}}</label>
        <br>

        @foreach($attributes as $attributeId)
            @php
                // Fetch the ProductVariant based on the attribute ID
                $variant = App\ProductVariant::find($attributeId);
            @endphp

            @if($variant)
                <label for="attribute_{{ $variant->id }}"><b>{{ ucfirst($variant->attribute_type) }}:</b></label>
                <span id="attribute_{{ $variant->id }}">{{ $variant->attribute_value }}</span><br>
            @else
                <label for="unknown_attribute"><b>Unknown Attribute:</b></label>
                <span id="unknown_attribute">No value found</span><br>
            @endif
        @endforeach
    </div>
@endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6 float-right">
                                <h2><br></h2>
                                <label for="firstname"><b>SubTotal :</b></label>
                                <span id="firstname">${{ $order->subtotal }}</span><br>

                                <label for="firstname"><b>Total Amount :</b></label>
                                <span id="firstname">${{ $order->Total }}</span><br>

                                <label for="lastname"><b>No Of Items :</b></label>
                                <span id="lastname">{{ $order->quantity }}</span><br>
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center">Order Details</h2>
                        @if($orderitems)
                            <div class="table-responsive m-t-10">
                                <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product Name</th>
                                            <th>Product SKU</th>
 <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderitems as $index => $item)
                                    <?php $index++ ?>
                                        <tr class="get_order_number">
                                            <td>#{{ $index }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{$item->price}}</td>
            
                        
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
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