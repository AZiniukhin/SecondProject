<?php

namespace App\Http\Controllers\Backend;

use App\CourierModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouriersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCouriers()
    {
        $result = CourierModel::getCouriers()->toArray();

        return view('backend.couriers', ['result' => $result]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCourier($id)
    {
        $result = CourierModel::getCouriers($id)->toArray();

        return view('backend.editCourier', ['result' => $result]);

//        return response()->json('success', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourier(Request $request)
    {
        //Log::info($request);

        DB::table('courier_models')
            ->where('id', $request['id'])
            ->update(['Company' => $request['Company'], 'Name' => $request['Name'], 'Surname' => $request['Surname']]);

        return redirect()->route('admin.showCouriers');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCourier($id)
    {
        //Log::info($request);

        DB::table('courier_models')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.showCouriers');

    }
}