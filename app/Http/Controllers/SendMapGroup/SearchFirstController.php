<?php

namespace App\Http\Controllers\SendMapGroup;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class SearchFirstController extends Controller
{

    public function searchFirst($id = '',$token = ''){

        $location_couriers = DB::table('location_couriers')->where('id', $id )
                                                            ->orderBy('created_at', 'desc')
                                                            ->limit(1)
                                                            ->get()
                                                            ->toArray();
        $locations = DB::table('locations')->where('tokenMap', $token )
                                                            ->orderBy('created_at', 'desc')
                                                            ->limit(1)
                                                            ->get()
                                                            ->toArray();
//        $location_couriers = DB::select("select * from location_couriers where id = \"$id\"");
//        $locations = DB::select("select * from locations where tokenMap = \"$token\"");
//        $marks = $location_couriers;
//        $obj_merged = $location_couriers . $locations;
        return array_merge($location_couriers,$locations);
//        return $obj_merged;
    }
}
