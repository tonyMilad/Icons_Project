<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    //

    protected $table = 'url';

     protected $fillable = [
        'user_id', 'url','status',
    ];


     public function user()
    {
        return $this->belongsTo('App\User');
    }

}
