<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $guarded = [];

    public function owner()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}
