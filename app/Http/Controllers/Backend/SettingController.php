<?php

namespace App\Http\Controllers\Backend;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //
    /**
     * Возвращает шаблон blade и коллекцию из бд из модели Setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetting()
    {
        return view('backend.setting', Setting::getSettings());
    }

    /**
     * Контроллер для сохранения значений Url в бд
     * так как у нас не будет других значений, а только заменяемый Url то сначало
     * надо удалить значения, после чего надо перебрать все значения полученные из таблицы в setting.blade.php
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSetting(Request $request)
    {
        Setting::where('key', '!=', NULL)->delete();
        foreach ($request->except('_token') as $key => $value) {

            $setting = new Setting();
            // тут берем уникальное имя поля из таблицы в setting.blade.php из input
            $setting->key = $key;
            // тут берем значение из поля input из значения value
            $setting->value = $request->$key;
            $setting->save();

        }
        return redirect()->route('admin.setting.showSetting');
    }

    // Создаем функцию для установки URI для webHook

    public function setWebHook(Request $request)
    {
        // setwebhook - это параметр взятый из документации к созданию телеграм бота
        // второй параметр это массив с параметрами в запросе. Они указываются в ключе запроса с именем query
        // (название ключа должно быть url, значение это поле из нашей формы и токен)
        $result = $this->sendTelegramData('setwebhook', [
            'query' => ['url' => $request->url . '/' . \Telegram::getAccessToken()]
        ]);


        // Редиректим на страницу по имени и добавляем к сообщению уведомления сессии свой параметр, для отображения
        // результата отправки данных на сервер телеграм, которые должны вернуться в формате json
        return redirect()->route('admin.setting.showSetting')->with('status', $result);
    }

    public function getWebHookInfo (Request $request) {

        $result = $this->sendTelegramData('getWebhookInfo');

        return redirect()->route('admin.setting.showSetting')->with('status', $result);

    }

    public function sendTelegramData($route = '', $params = [], $method = 'POST')
    {
        // Создаем объект клиента Guzzle в который передадим базовый параметр URI для нашего TelBot
        // В фасаде \Telegram::getAccessToken мы передаем токен взятый из config/telegram.php

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot' . \Telegram::getAccessToken() . '/']);

        // Создаю переменную которая будет принимать результат запроса от TelBot

        $result = $client->request($method, $route, $params);

        // string обязателен ибо когда добавлять через команду flash в Session эти данные то нужно из передавать через string
        return (string) $result->getBody();

    }


}
