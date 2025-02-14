<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;
    protected $table = 'slides';
    protected $guarded = [];

    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }
}