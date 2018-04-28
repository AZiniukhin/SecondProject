<?php
/**
 * Created by PhpStorm.
 * User: zipman
 * Date: 01.04.18
 * Time: 12:39
 */

namespace App\Telegram;
use App\CourierModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;


class MyOrdersCommand
{

    /**
     * Выводит значения всех заказов взятых курьером ввиде строк в Telegram
     *
     * @param $telegram
     * @return string
     */
    public static function myOrders($telegram)
    {
        $resultCourier = CourierModel::getOneCourier($telegram['message']['from']['id']);

        $company = $resultCourier['Company'];

        $resultOrder = DB::table($company . '_orders')
            ->where([
                ['TelBot', '=', $telegram['message']['from']['id']],
                ['Status', '=', 'InWork']
            ])->get()->toArray();

        $result = '';

        foreach ($resultOrder as $order){
            foreach ($order as $key => $value){
                if($key == 'id' || $key == 'Address' || $key == 'TimeDelivery'){
                    $result .= ' / ' . $value . ' / ';
                }
            }
            $result .= PHP_EOL;
            $result .= PHP_EOL;
        }

        return $result;
    }
}