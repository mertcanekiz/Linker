<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function link()
    {
      return $this->belongsTo('App\Link');
    }
}
