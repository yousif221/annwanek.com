<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'category';
    protected $guarded = [];

    public function business()
    {
        return $this->hasMany(Business::class, 'category_id'); // Specify the foreign key
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($business) {
            // Delete associated wishlists
            $business->business()->delete();
        });
    }
}