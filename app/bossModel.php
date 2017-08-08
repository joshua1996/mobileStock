<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class bossModel extends Authenticatable
{
    protected $table = 'boss';
    public $timestamps = false;
    protected $primaryKey = 'bossID';
    public $incrementing = false;
}
