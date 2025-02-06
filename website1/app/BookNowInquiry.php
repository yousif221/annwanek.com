<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookNowInquiry extends Model
{
    use SoftDeletes;
    protected $table = 'booknow';
    protected $guarded = [];
    
   
    public function service()
    {
        // Specifies the related model (User), foreign key (user_id), and local key (id)
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
