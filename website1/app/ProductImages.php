<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $guarded = [];

    public function product_images(){
        return $this->hasOne(Product::class, 'id', 'product_id');
     
    }
}