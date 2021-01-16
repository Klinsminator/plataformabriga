<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationArea extends Model
{
    public function professional()
    {
        return $this->belongsToMany('App\Professional');
    }

    public function profile()
    {
        return $this->belongsToMany('App\Profile');
    }

    public function Recommendation()
    {
        return $this->belongsToMany('App\Recommendation');
    }
}
