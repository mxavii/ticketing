<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";
    public $timestamps = false;
    protected $fillable = ['passenger_id','fare_id'];
}
