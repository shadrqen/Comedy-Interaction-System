<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'itemId', 'itemType', 'userId', 'coment'
    ];

    public function meme()
    {
        return $this->belongsTo('App\MemesModel', 'userId');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
