<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
  protected $guarded = [];

  public function link()
  {
    return $this->belongsTo('App\Link');
  }

  public function owner()
  {
    return $this->hasOneThrough('App\User', 'App\Link');
  }
}
