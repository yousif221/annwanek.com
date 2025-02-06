<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blogs';
    protected $guarded = [];

    public function state(){
        return $this->hasOne(State::class, 'id', 'state_id');
     
    }
}