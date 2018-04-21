<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Anthenticatable;
class User extends Anthenticatable
{
    protected $fillable = [
      'name','email','password',
    ];
}
