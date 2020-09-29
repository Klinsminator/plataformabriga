<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    public function profile()
    {
        return $this->belongsToMany('App\Profile');
    }
}
