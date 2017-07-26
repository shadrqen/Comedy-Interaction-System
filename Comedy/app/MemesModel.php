<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemesModel extends Model
{
    protected $table = 'memes';

    protected $fillable = [
        'image', 'comment', 'userId', 'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function commentsM()
    {
        return $this->hasMany('App\CommentsModel', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\LikesModel', 'userId');
    }
}
