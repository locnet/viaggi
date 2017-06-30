<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    protected $fillable = ['name', 'email', 'token', 'visitor_ip'];
}
