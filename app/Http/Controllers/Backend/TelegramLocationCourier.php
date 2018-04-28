<?php

namespace App\Http\Controllers\Backend;

use App\LocationCourier;
use App\Telegram\DeliveredCommand;
use App\Telegram\DeliveryCommand;
use App\Telegram\MyOrdersCommand;
use App\Telegram\OrdersCommand;
use App\Telegram\RegistrationCouriersCommand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class TelegramLocationCourier extends Controller
{
    //
    public function webHook()
    {
        $telegram = Telegram::getWebhookUpdates();

        if (isset($telegram['callback_query']['data'])) {

            // Получение телефона клиента с изменением статуса на "Delivery"
            $userPhone = DeliveryCommand::changeStatusOrder($telegram['callback_query']['data'], $telegram['callback_query']['from']['id']);

            // Проверка единичной доставки заказа, чтобы не было двойных доставок
            if($userPhone == NULL){
                $message = 'У Вас уже есть один заказ в доставке';
            } else {
                $user = md5(uniqid(rand(), true));
                $courierID = $telegram['callback_query']['from']['id'];
                $message = 'https://ok.findme.php.a-level.com.ua/courierMap/' . $courierID . '/' . $user . '/' . $userPhone;
            }

            Telegram::sendMessage([
                'chat_id' => $telegram['callback_query']['from']['id'],
                'text' => $message
            ]);
        }


        if (isset($telegram['message']['contact'])) {
            $message = RegistrationCouriersCommand::registrationCouriers($telegram);
            Telegram::sendMessage([
                'chat_id' => $telegram['message']['from']['id'],
                'text' => $message
            ]);
        }


        if (isset($telegram['message']['text'])) {
            if (substr($telegram['message']['text'], 0, 1) == '#') {
                $order = substr($telegram['message']['text'], 1);
                $courier = $telegram['message']['from']['id'];
                $message = OrdersCommand::takeOrder($order, $courier);
                Telegram::sendMessage([
                    'chat_id' => $telegram['message']['from']['id'],
                    'text' => $message
                ]);
            } elseif (substr($telegram['message']['text'], 0, 1) == '%') {
                $order = substr($telegram['message']['text'], 1);
                $courier = $telegram['message']['from']['id'];
                $message = OrdersCommand::revokeOrder($order, $courier);
                Telegram::sendMessage([
                    'chat_id' => $telegram['message']['from']['id'],
                    'text' => $message
                ]);
            } elseif (substr($telegram['message']['text'], 0, 1) == '*') {
                $code = substr($telegram['message']['text'], 1);
                $courier = $telegram['message']['from']['id'];
                $message = OrdersCommand::codeRegistration($code, $courier);
                Telegram::sendMessage([
                    'chat_id' => $telegram['message']['from']['id'],
                    'text' => $message
                ]);
            }


            switch ($telegram['message']['text']) {
                case 'Orders' :
                    $message = OrdersCommand::orders($telegram);
                    Telegram::sendMessage([
                        'chat_id' => $telegram['message']['from']['id'],
                        'text' => $message
                    ]);
                    break;
                case 'Delivery' :
                    $message = DeliveryCommand::delivery($telegram);
                    Telegram::sendMessage([
                        'chat_id' => $telegram['message']['from']['id'],
                        'text' => $message['text'],
                        'reply_markup' => $message['keyboard']
                    ]);
                    break;
                case 'My orders' :
                    $message = MyOrdersCommand::myOrders($telegram);
                    Telegram::sendMessage([
                        'chat_id' => $telegram['message']['from']['id'],
                        'text' => $message
                    ]);
                    break;
                case 'Delivered' :
                    $message = DeliveredCommand::delivered($telegram);
                    Telegram::sendMessage([
                        'chat_id' => $telegram['message']['from']['id'],
                        'text' => $message
                    ]);
                    break;
            }
        }

        // ----------------------------------------------------------------

        //          Отвечает за запись геоданных в базу данных

        // ----------------------------------------------------------------

        if (isset($telegram['message']['location'])) {

            $all = array_merge(json_decode($telegram['message']['from'], true), json_decode($telegram['message']['location'], true));

            LocationCourier::create($all);

        } elseif (isset($telegram['edited_message']['location'])) {

            $arrDate = $telegram['edited_message']['from'];

            $arrLocation = $telegram['edited_message']['location'];

            $all = array_merge($arrDate, $arrLocation);

            LocationCourier::create($all);
        }

        Telegram::commandsHandler(true);
    }
}
