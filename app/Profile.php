<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function applicant()
    {
        return $this->belongsTo('App\Applicant');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function commentary()
    {
        return $this->hasMany('App\Commentary');
    }

    public function symptom()
    {
        return $this->belongsToMany('App\Symptom');
    }

    public function recommendation()
    {
        return $this->belongsToMany('App\Recommendation');
    }

    public function recommendationArea()
    {
        return $this->belongsToMany('App\RecommendationArea');
    }
}
