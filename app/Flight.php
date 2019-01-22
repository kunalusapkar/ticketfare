<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{   
   protected $fillable = ['from_airport', 'to_airport','lowest_fare'];
}
