<?php

namespace App\ModelGroup;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';

    protected $fillable = ['token','tokenMap', 'latitude', 'longitude'];

}
