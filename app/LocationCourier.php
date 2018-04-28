<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationCourier extends Model
{
    //
    protected $fillable = [
        'id', 'first_name',  'last_name', 'username', 'latitude', 'longitude',
    ];
}
