<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    public function recommendationArea()
    {
        // Hasmany didn't work so change to manyto many relationship
        // both parent and child has the belongsToMany relationship
        // REMEMBER this relationship is managed with a pivot table
        // the system would use the pivot table to match id vs id
        return $this->belongsToMany('App\RecommendationArea');
    }

    public function office()
    {
        return $this->belongsToMany('App\Office');
    }
}
