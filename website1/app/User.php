<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Description;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'contact', 'password', 'username', 'country', 'role', 'referral_id', 'referrer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $roles = [
        0 => 'Administrator',
        1 => 'Customer',
    ];
    
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function name($pos = 0) {
        switch ($pos) {
            case 1:
                return $this->first_name;
                break;
            case 2:
                return $this->last_name;
                break;
            default:
                return $this->first_name.' '.$this->last_name;
        }
    }

    public function hasRole($role) {
        return $this->role == array_search($role, User::$roles);
    }

    public function accountType() {
        return User::$roles[$this->role];
    }
}
