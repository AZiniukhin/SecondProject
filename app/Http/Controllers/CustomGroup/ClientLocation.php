<?php
/**
 * Created by PhpStorm.
 * User: iambatman
 * Date: 09.04.18
 * Time: 14:18
 */

namespace App\Http\Controllers\CustomGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\ModelGroup\Location;

class ClientLocation
{
    public function setLocation(Request $request) {

        //задаем локацию

        //   echo ($request->only('_token'))['_token'];

        $token = $request->input('_token');

        $lat = $request->input('lat');

        $lng = $request->input('lng');

        $tokenMap = $request->input('id_map');

        //Log::warning("data: TOKEN: " .$request->input('_token') );


        $location = Location::create(
            [
                'token' => $token,
                'tokenMap' =>$tokenMap,
                'latitude' => $lat,
                'longitude' => $lng
            ]
        );

        $location->save();

//        return redirect('/');

        return ["saved" => 'ok'];
    }
}