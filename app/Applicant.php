<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    public function profile()
    {
        return $this->hasMany('App\Profile');
    }

    public function comentary()
    {
        return $this->hasMany('App\Commentary');
    }
}
