<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikesModel extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'itemId', 'itemType', 'userId'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function memes()
    {
        return $this->belongsTo('App\MemesModel', 'itemId');
    }
}
