<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Так как в миграции не указаны поля для создания времени записи и обновления то тут указываем false
    public $timestamps = false;

    public static function getSettings($key = null)
    {
        // в переменную $settings записываем результат запроса в бд через тернарную операцию
        // если true, то обращаемся к этому же классу и сравниваем ключ 'key' с указанным каким-то конкретным ключем
        // поступающим в метод через переменную $key и добавляем метод first() чтобы вернуть одно значение
        // Если false то записываем все значения из таблицы через self::get()

        $settings = $key ? Setting::where('key', $key)->first() : self::get();

        // Чтобы все это вернуть в удобном нам виде создаем коллекцию

        $collect = collect();

        // Перебираем полученную коллекцию из таблицы Settings

        foreach ($settings as $setting) {
            // Кладем в коллекцию одноименные данные из таблицы
            $collect->put($setting->key, $setting->value);
        }

        return $collect;
    }
}
