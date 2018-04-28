<?php

namespace App\Http\Controllers\CustomGroup;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\ModelGroup\Location;

class LocationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLocation()
    {
        $token = Session::get('_token');

        $arr = ['title' => 'OkFindMe',
            'id' => $token
        ];

//        dd(Session::get('_token'));


        if (view()->exists('default.home')) {
            return view('default.home', $arr);
        }
        abort(404);
    }

    /**
     * @return string
     */
    public function randomString()
    {
        $chars = "abcdefghijklmnopqrstuwxyz123";
        $result = "";
        for ($i = 0; $i < 50; $i++) {
            $result .= $chars[rand(0, 20)];
        }
        return $result;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function setLocation(Request $request)
    { //задаем локацию

//        echo ($request->only('_token'))['_token'];

        $token = $request->input('_token');

        $lat = $request->input('lat');

        $lng = $request->input('lng');

        $tokenMap = "mytoken";

        $tokenMap .= $request->input('_token');

        //Log::warning("data: TOKEN: " .$request->input('_token') );


        $location = Location::create(
            [
                'token' => $token,
                'tokenMap' => $tokenMap,
                'latitude' => $lat,
                'longitude' => $lng
            ]
        );

        $location->save();

//        return redirect('/');

        return ["saved" => 'oasdsadk', "key" => $this->randomString()];
    }
}
