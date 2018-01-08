<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Gstt\Achievements\Achiever;

class User extends Authenticatable
{
    use Notifiable;
    use Achiever;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function slike()
    {
        return $this->hasMany('App\Slika', 'user_id');
    }

    public function upvotes()
    {
        return $this->hasMany('App\Glas', 'user_id')->where('type', 1);
    }


}
