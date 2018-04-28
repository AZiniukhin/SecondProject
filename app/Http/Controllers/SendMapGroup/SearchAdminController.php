<?php

namespace App\Http\Controllers\SendMapGroup;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class SearchAdminController extends Controller
{

    public function searchAdmin(){

        $location_admin = DB::table('courier_models')
            ->join('location_couriers','courier_models.TelBot','=','location_couriers.id')
            ->select('location_couriers.id', 'courier_models.Name as first_name', 'courier_models.Surname','longitude','latitude', DB::raw('MAX(location_couriers.created_at) AS  created_at') )
            ->groupBy('location_couriers.id')
            ->get()
            ->toArray();

        return $location_admin;
    }
}
