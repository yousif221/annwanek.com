<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetter extends Model
{
    use SoftDeletes;
    protected $table = 'newsletters';
    protected $guarded = [];
}
