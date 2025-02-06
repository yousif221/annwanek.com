<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes;
    protected $table = 'claims';
    protected $guarded = [];

    public function business(){
        return $this->hasOne(Business::class, 'id', 'business_id');
     
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
     
    }
}