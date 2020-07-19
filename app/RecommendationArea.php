<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationArea extends Model
{
    public function professional()
    {
        return $this->belongsToMany('App\Professional');
    }
}
