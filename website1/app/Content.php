<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'page', 'title', 'subtitle', 'description', 'short_description', 'button_text', 'btn_color', 'link', 'primary_image', 'secondary_image', 'video'
    ];
}
