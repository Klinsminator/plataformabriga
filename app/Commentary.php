<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
    
    public function applicant()
    {
        return $this->belongsTo('App\Applicant');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
