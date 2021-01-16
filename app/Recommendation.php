<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function RecommendationArea()
    {
        return $this->belongsToMany('App\RecommendationArea');
    }
}
