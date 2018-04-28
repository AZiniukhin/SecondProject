<?php
/**
 * Created by PhpStorm.
 * User: zipman
 * Date: 01.04.18
 * Time: 12:37
 */

namespace App\Telegram;
use App\CourierModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;


class DeliveryCommand
{
    public static function delivery($telegram)
    {

        $resultCourier = CourierModel::getOneCourier($telegram['message']['from']['id']);

        $company = $resultCourier['Company'];

        $resultOrder = DB::table($company . '_orders')
            ->where([
                ['TelBot', '=', $telegram['message']['from']['id']],
                ['Status', '=', 'InWork']
            ])->get()->toArray();

        $data = [];
        foreach ($resultOrder as $value) {
            $data[] = [
                'text' => $value->id,
                'callback_data' => $value->id
            ];
        }

        $text = 'Выберите номер заказа';

        $inline_keyboard = json_encode([
           'inline_keyboard' => [
               $data
           ]
        ]);

        return ['text' => $text, 'keyboard' => $inline_keyboard];
    }

    public static function changeStatusOrder($number, $courier)
    {
        $resultCourier = CourierModel::getOneCourier($courier);

        $company = $resultCourier['Company'];

        $checkCourier = DB::table($company . '_orders')
            ->where([
                ['TelBot', '=', $courier],
                ['Status', '=', 'Delivery']
            ])->value('id');

        if ($checkCourier == NULL) {
            DB::table($company . '_orders')
                ->where('id', $number)
                ->update(['Status' => 'Delivery']);

            $result = DB::table($company . "_orders")->where('id', '=', $number)->value('TelClient');
            return $result;

        } else {
            return NULL;
        }
    }
}