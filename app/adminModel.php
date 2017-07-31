<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class adminModel extends Authenticatable
{
    protected $table = 'admin';
    public $timestamps = false;
    protected $primaryKey = 'adminID';
    public $incrementing = false;
}
