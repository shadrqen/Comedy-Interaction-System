<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function meme()
    {
        return $this->hasMany('App\MemesModel', 'userId');
    }

    public function comments()
    {
        return $this->hasMany('App\CommentsModel', 'userId');
    }

}
