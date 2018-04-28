<?php
/**
 * Created by PhpStorm.
 * User: zipman
 * Date: 01.04.18
 * Time: 12:41
 */

namespace App\Telegram;
use App\CourierModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class DeliveredCommand
{

    /**
     * Изменяет параметр "Доставляется" на "Доставлено"
     * с учетом того к какой компании принадлежит курьер
     *
     * @param $telegram
     * @return string
     */
    public static function delivered($telegram)
    {
        $resultCourier = CourierModel::getOneCourier($telegram['message']['from']['id']);

        $company = $resultCourier['Company'];

        DB::table($company . '_orders')
            ->where([
                ['TelBot', '=', $telegram['message']['from']['id']],
                ['Status', '=', 'Delivery']
            ])
            ->update(['Status' => 'Delivered']);

        $idOrder = DB::table($company . "_orders")
            ->where([
                ['TelBot', '=', $telegram['message']['from']['id']],
                ['Status', '=', 'Delivered']
            ])
            ->value('id');

        $result = "Статус заказа №" . $idOrder . " изменен на 'Доставлен'";

        return $result;

    }

}