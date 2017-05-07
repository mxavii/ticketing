<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    public $timestamps = false;
    protected $table = "auth";
    protected $fillable = ['agent_id','key','expired','login'];
}
