<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primaryKey = 'id';
    // Show Timestamps
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
