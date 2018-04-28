<?php

namespace App\Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;


/**
 * Class HelpCommand.
 */
class TestCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'test';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $user = \App\User::find(2);

        $this->replyWithMessage(['text' => 'Ваш email при регистрации: ' . $user->email . ' и Ваше имя: ' . $user->name]);

        $telegramUser = \Telegram::getWebhookUpdates()['message'];

        $text = sprintf('%s: %s' . PHP_EOL, 'Ваш номер чата', $telegramUser['from']['id']);
        $text .= sprintf('%s: %s' . PHP_EOL, 'Ваше имя пользователя в телеграм', $telegramUser['from']['username']);

        $this->replyWithMessage(compact('text'));

    }
}
