<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class userModel extends Authenticatable
{
    protected $table = 'user';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'userID';
}
