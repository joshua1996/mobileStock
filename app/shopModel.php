<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shopModel extends Model
{
    protected $table = 'shop';
    protected $fillable = ['shopID', 'shopName', 'bossID'];
    protected $primaryKey = 'shopID';
    public $incrementing = false;
}
