<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    // protected $fillable = [
    //     'name',
    //     'logo',
    //     'business_image',
    //     'menu_image',
    //     'interior_image',
    //     'category_id',
    //     'start_time',
    //     'end_time',
    //     'address',
    //     'website',
    //     'phone',
    //     'email',
    // ];
    protected $table = 'businesses';

  
    public function menuItems(){
        return $this->hasMany(MenuItem::class, 'business_id', 'id');
     
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews(){
        return $this->hasMany(Reviews::class, 'business_id', 'id');
     
    }
    public function getAverageReviews()
    {
        $reviews = $this->reviews; // Get all reviews for the business

        // Check if there are any reviews
        if ($reviews->count() > 0) {
            // Calculate averages for each field
            $averageFood = $reviews->avg('food');
            $averageService = $reviews->avg('service');
            $averageValue = $reviews->avg('value');
            $averageAtmosphere = $reviews->avg('atmosphere');
            
            return [
                'food' => round($averageFood, 1),
                'service' => round($averageService, 1),
                'value' => round($averageValue, 1),
                'atmosphere' => round($averageAtmosphere, 1),
            ];
        }
        
        // If no reviews, return default values
        return [
            'food' => 0,
            'service' => 0,
            'value' => 0,
            'atmosphere' => 0,
        ];
    }
}