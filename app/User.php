<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    // if pointing to a table that doesn't has the same name than the class:
    // protected $table = 'users2'

    // this is enough to get laravel implement authentication
    use \Illuminate\Auth\Authenticatable;

    // this is an Eloquent relation, this means, that the user
    // belongs to a userType in database terms
    public function userType()
    {
        return $this->belongsTo('App\UserType');
    }
}
