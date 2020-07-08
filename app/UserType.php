<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    // this is an Eloquent relation, this means, that the usertype
    // has many users, or in this case, that a usertype can
    // be related to many users on the database
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
