<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use SoftDeletes;
    protected $table = 'product_var';
    protected $guarded = [];

    public function productvar(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
