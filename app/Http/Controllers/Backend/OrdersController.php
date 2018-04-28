<?php

namespace App\Http\Controllers\Backend;

use App\CourierModel;
use App\yakitoryOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOrders()
    {
        $client = Auth::user()->name;

        $access = Auth::user()->status;

        switch($client !== NULL || $access !== NULL){
            case ($client == 'yakitory') :
                $result = yakitoryOrder::getOrders()->toArray();
                break;
            case ($access == 'admin') :
                $result = yakitoryOrder::getOrders()->toArray();
                break;
        }

//        Log::info($result);

        return view('backend.showOrders', ['result' => $result]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createOrder(){
        $client = Auth::user()->name;

        $access = Auth::user()->status;

        switch($client !== NULL || $access !== NULL){
            case ($client == 'yakitory') :
                $result = yakitoryOrder::getOrders()->toArray();
                break;
            case ($access == 'admin') :
                $result = yakitoryOrder::getOrders()->toArray();
                break;
        }

//        Log::info($result);

        return view('backend.createOrder', ['result' => $result]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOneOrder(Request $request)
    {
//        $client = Auth::user()->name;

        $client = 'yakitory';
//
        DB::table( $client . '_orders')->insert([
            'TelBot' => $request['TelBot'],
            'TelClient' => $request['TelClient'],
            'Address' => $request['Address'],
            'NumberOrder' => $request['NumberOrder'],
            'Status' => $request['Status'],
            'TimeDelivery' => $request['TimeDelivery']
        ]);

        return redirect()->route('admin.showOrders');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOneOrder($id)
    {
//        Log::info($id);

        $client = Auth::user()->name;

        $access = Auth::user()->status;

        switch($client !== NULL || $access !== NULL){
            case ($client == 'yakitory') :
                $result = yakitoryOrder::getOrders($id)->toArray();
                    if($result['TelBot'] !== NULL){
                        $result['TelBot'] = $this->getNameCourier($result['TelBot']);
                }
                break;
            case ($access == 'admin') :
                $result = yakitoryOrder::getOrders($id)->toArray();
                if($result['TelBot'] !== NULL){
                    $result['TelBot'] = $this->getNameCourier($result['TelBot']);
                }
                break;
        }

        return view('backend.showOneOrder', ['result' => $result]);
    }

    /**
     * @param $number
     * @return string
     */
    private function getNameCourier($number)
    {
        $result = CourierModel::getOneCourier($number)->toArray();

        return ($result['Name'] . ' ' . $result['Surname']);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editOrder($id)
    {

        $client = Auth::user()->name;

        $access = Auth::user()->status;

        switch($client !== NULL || $access !== NULL){
            case ($client == 'yakitory') :
                $result = yakitoryOrder::getOrders($id)->toArray();
                break;
            case ($access == 'admin') :
                $result = yakitoryOrder::getOrders($id)->toArray();
                break;
        }

        return view('backend.editOrder', ['result' => $result]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editOneOrder(Request $request)
    {
//        $client = Auth::user()->name;

        $client = 'yakitory';

        DB::table($client . '_orders')
            ->where('id', $request['id'])
            ->update([
                'TelClient' => $request['TelClient'],
                'Address' => $request['Address'],
                'NumberOrder' => $request['NumberOrder'],
                'Status' => $request['Status'],
                'TimeDelivery' => $request['TimeDelivery']
            ]);

        return redirect()->route('admin.showOrders');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteOrder($id)
    {
//        $client = Auth::user()->name;

        $client = 'yakitory';

        DB::table($client . '_orders')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.showOrders');
    }

}
