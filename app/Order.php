<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public static $order_status = [
    	0 =>'pending',
    	1 =>'Out for delivery',
    	2 =>'Delivered',
        3 =>'Ariving',
        4 =>'Cancel',
    ];

    public function status(){
        return Order::$order_status[$this->order_status];
    }
}