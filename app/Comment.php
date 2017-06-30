<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Table Name
    protected $table = 'comments';
    
    // public function post() {
    //     return $this->belongsTo('App\Post');
    // }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
