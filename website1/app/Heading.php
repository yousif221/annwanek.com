<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Heading extends Model
{
    use SoftDeletes;
    protected $table = 'headings';
    protected $guarded = [];

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
}