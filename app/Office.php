<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function professional()
    {
        return $this->belongsToMany('App\Professional');
    }
}
