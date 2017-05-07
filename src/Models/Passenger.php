<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public $timestamps = false;
    protected $table = "passengers";
    protected $fillable = ['name','title','phone','email','address'];
}
