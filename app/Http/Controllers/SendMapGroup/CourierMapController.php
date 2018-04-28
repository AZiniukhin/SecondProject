<?php

namespace App\Http\Controllers\SendMapGroup;


class CourierMapController
{

    public function index($id = '', $id_map = '')
    {
        return  view('default.courierMapCourier', ['tokenMap' => $id, 'id_map' => $id_map]);
    }
}