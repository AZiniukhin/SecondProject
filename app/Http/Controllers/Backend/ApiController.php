<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\yakitoryOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // Принимает JSON от компании, валидирует данные и при успешности записывает
    // в бд заказов компании приславшей JSON

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {

        $user = User::where('api_key', $request->api_key)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'TelClient' => 'required|string|min:7|max:13',
            'Address' => 'required|string|min:5|max:50',
            'NumberOrder' => 'required|string|min:1|max:20',
            'TimeDelivery' => 'required|string|min:1|max:6'
//
//              Вариант с раздельным составлением времени
//
//            'TimeDelivery.hours' => 'required|numeric|between:0,23',
//            'TimeDelivery.minutes' => 'required|numeric|between:0,59'
        ]);

        $request = $request->toArray();

        if($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            if($user->name == 'yakitory'){
                yakitoryOrder::setOrder($request);
            }
        }

        return response()->json(['status' => 'access'], 200);
    }

}
