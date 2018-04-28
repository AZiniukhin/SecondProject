<?php
/**
 * Created by PhpStorm.
 * User: zipman
 * Date: 01.04.18
 * Time: 2:19
 */

namespace App\Telegram;
use App\CourierModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;


class OrdersCommand
{

    /**
     * Выводит все свободные для взятия в работу заказы,
     * с описанием как их "принимать в работу" и как "снять заказ"
     *
     * @param $telegram
     * @return string
     */
    public static function orders($telegram)
    {

        $resultCourier = CourierModel::getOneCourier($telegram['message']['from']['id']);

        $company = $resultCourier['Company'];

        $resultOrder = DB::table($company . '_orders')
            ->where([
                ['TelBot', '=', NULL],
                ['Status', '=', 'Wait']
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
        $result .= "Чтобы взять в работу заказ, наберите знак '#' и после него номер заказа";
        $result .= PHP_EOL;
        $result .= PHP_EOL;
        $result .= "Чтобы снять заказ, наберите знак '%' и после него номер заказа";

        return $result;
    }

    /**
     * Устанавливает статус заказа в позицию "InWork"
     * и закрепляет этот заказ за конкретным курьером по номеру в Telegram
     *
     * @param $order
     * @param $courier
     * @return string
     */
    public static function takeOrder($order, $courier)
    {
        $result = CourierModel::getOneCourier($courier)->toArray();

        $company = $result['Company'];

        $db = DB::table($company . "_orders")->where('id', '=', $order)->value('TelBot');

        if ($db !== NULL ){
            $text = "Заказ под номером " . $order . " уже в работе";
            return $text;
        } else {
            DB::table($company . "_orders")
                ->where('id', $order)
                ->update([
                    'TelBot' => $courier,
                    'Status' => 'InWork'
                ]);
            $text = "Заказ под номером " . $order . " принят Вами в работу";
            return $text;
        }
    }

    /**
     * Снимает заказ с курьера, и возвращает статус в положение "Wait", открепляя номер курьера
     *
     * @param $order
     * @param $courier
     * @return string
     */
    public static function revokeOrder($order, $courier)
    {
        $result = CourierModel::getOneCourier($courier)->toArray();

        $company = $result['Company'];

        $db = DB::table($company . "_orders")->where([['id', '=', $order], ['TelBot', '=', $courier]])->value('TelBot');

        if ($db !== NULL ){
            DB::table($company . "_orders")
                ->where('id', $order)
                ->update([
                    'TelBot' => NULL,
                    'Status' => 'Wait'
                ]);
            $text = "Заказ под номером " . $order . " переведен в статус Wait";
            return $text;
        } else {
            $text = "Заказ под номером " . $order . " в статусе Wait";
            return $text;
        }
    }

    /**
     * Проверяет секретный код компании и записывает в таблицу копании пользователя как их курьера
     *
     * @param $code
     * @param $courier
     * @return string
     */
    public static function codeRegistration($code, $courier)
    {

        $allUsers = DB::table('users')
            ->select('name', 'code')
            ->get()->toArray();

        $message = 'Ok';

        foreach ($allUsers as $user){
            if($user->code == $code){
                $company = $user->name;
                DB::table('courier_models')
                    ->where('TelBot', $courier)
                    ->update(['Company' => $company]);
                $message = 'Вы зарегистрированы как курьер в компании '. $company;
            } else {
                $message = 'Код не верен, попробуйте еще раз.';
            }
        }

        return $message;

    }

}