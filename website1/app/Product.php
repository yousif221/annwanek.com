<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maize\Markable\Markable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maize\Markable\Models\Favorite;
class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
     
    }
    public function reviews(){
        return $this->hasMany(Reviews::class, 'product_id', 'id');
     
    }
    public function averageRating()
{
    return $this->reviews()->avg('review');  // Assumes each review has a 'rating' field
}
    public function productvar(){
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

}


