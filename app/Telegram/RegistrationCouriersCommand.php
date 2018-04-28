<?php

namespace App\Telegram;
use App\CourierModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;


/**
 * Class HelpCommand.
 */
class RegistrationCouriersCommand
{

    /**
     * Регистрирует нового курьера в БД
     *
     * @param $telegram
     * @return string
     */
    public static function registrationCouriers($telegram)
    {

        $tel = CourierModel::firstOrCreate(['TelBot' => $telegram['message']['from']['id']], [
           'Telephone' => $telegram['message']['contact']['phone_number'],
            'TelBot' => $telegram['message']['from']['id']
        ]);

        $text = 'Введите секретный код начиная с знака *';

        return $text;

    }
}