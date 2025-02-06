@extends('layouts.admin.app')
@section('title', 'DASHBOARD')
@section('css')
@endsection
@section('content')
<div class="content">
    <div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-sm-12 p-4">
                <div class="white-box card">
                    <div class="card-body">
                        <h3 class="box-title pull-left">Order # {{$order->order_number}}</h3>
                        <a href="{{url('/panel/Orders')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right"> Back</a>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Customer Information:</h2>
                                <label for="firstname"><b>Customer Name :</b></label>
                                <span id="firstname">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</span><br>

                                <label for="useremail"><b>Email :</b></label>
                                <span id="useremail">{{ $order->billing_email }}</span><br>

                                <label for="usercontact"><b>Contact :</b></label>
                                <span id="usercontact">{{ $order->billing_contact }}</span>
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
                            </div>
                            </div>
                            <div class="row">
                        @foreach($orderitem as $key => $order_detailed)
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
                            <div class="col-md-4">
                                <h2><br></h2>

                                <label for="firstname"><b>SubTotal :</b></label>
                                <span id="firstname">${{ $order->subtotal }}</span><br>

                                <!-- <label for="firstname"><b>Discount Amount :</b></label>
                                <span id="firstname">${{$order->subtotal - $order->Total }}</span><br> -->


                                <label for="firstname"><b>Total Amount :</b></label>
                                <span id="firstname">${{ $order->Total }}</span><br>

                                <label for="lastname"><b>No Of Items :</b></label>
                                <span id="lastname">{{ $order->quantity }}</span><br>
                                @php $transaction_id = unserialize($order->payment_info) @endphp
                                @if($order->payment_info != null)
                                <label for="customer_zip"><b>Transaction ID :</b></label>
                                <span id="customer_zip"><?= (isset($transaction_id['paymentIntent']['id'])) ? $transaction_id['paymentIntent']['id'] : $transaction_id['paymentID']   ?></span><br>
                                @endif
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center">Order Details</h2>
                        @if($orderitem)
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
                                    @foreach($orderitem as $index => $item)
                                    <?php $index++ ?>
                                        <tr class="get_order_number">
                                            <td>#{{ $index }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sku }}</td>

                                            <td>${{ $item->price }}</td>
            
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="status_select col-md-4">
                    <form method="POST" action="{{ url('/panel/order/'.$item->order_id) }}">
                        @method('put')
                        @csrf
                        <select class="form-control" id="order_status" name="order_status"  onchange="yesnoCheck(this);">
                            @foreach(\app\Order::$order_status as $key => $status)
                            <option {{($order->order_status == $key)? 'selected':''}} value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                <br>
                        <div id="ifYes" style="display: none;">
                            <label for="car">Ariving Time</label> <br><input type="text" id="car" name="ariving_time" value="{{ $order->ariving_time}}"/><br />
                        </div>
              
                      <br>  <button class="btn btn-success btn-sm">Confirm <i class="fa fa-check-circle"></i></button>
                        <input type="hidden" name="order_number" value="{{ $item->order_id }}">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function yesnoCheck(that) {
        if (that.value == 3 || that == 3) {
            document.getElementById("ifYes").style.display = "block";
        } else {
        document.getElementById("ifYes").style.display = "none";
    }
}
@if($order->order_status == 3)
yesnoCheck(3);
@endif
</script>
@endsection