<?php

namespace App\Http\Controllers\SendMapGroup;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;


class MapController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//       $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = '', $id_map = '')
    {
//
        return  view('default.mapCourier', ['tokenMap' => $id, 'id_map' => $id_map]);
    }
}