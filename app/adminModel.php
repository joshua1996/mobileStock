<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class adminModel extends Authenticatable
{
    protected $table = 'admin';
    protected $fillable = ['adminID', 'adminName', 'password', 'shopID'];
    protected $primaryKey = 'adminID';
    public $incrementing = false;
}
