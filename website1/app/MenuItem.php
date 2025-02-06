<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
    ];
    use SoftDeletes; 
    protected $table = 'menu_items';
    protected $guarded = [];
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}