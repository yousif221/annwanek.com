<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    protected $table = 'states';
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'state_id'); // Specify the foreign key
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($blogs) {
            // Delete associated wishlists
            $blogs->blogs()->delete();
        });
    }
}

