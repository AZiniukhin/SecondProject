<?php

namespace App\Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Log;
//use Telegram\Bot\Keyboard\Keyboard;


/**
 * Class HelpCommand.
 */
class LocationCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'GS';

    /**
     * @var string Command Description
     */
    protected $description = 'Get Start to work';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $locationUser = \Telegram::getWebhookUpdates();

        $keyboard = [
            [[
                'text'=>'Registration',
                'request_contact'=>true,
            ]],
            ['Orders', 'My orders'],
            ['Delivery', 'Delivered']
        ];

        $reply_markup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);


// -------------------------------------------------------------------------------------
//          Часть клавиатуры отвечающая за единичное посылание отметки геолокации боту
//

//            $reply_markup = \Telegram::replyKeyboardMarkup([
//                'keyboard' => [[
//                    ['text' => 'location',
//                    'request_location' => true
//               ]]],
//                'resize_keyboard' => true,
//                'one_time_keyboard' => true
//            ]);
// -------------------------------------------------------------------------------------

        $response = \Telegram::sendMessage([
            'chat_id' => $locationUser['message']['from']['id'],
            'text' => 'Please make your choice',
            'reply_markup' => $reply_markup
        ]);
    }
}
