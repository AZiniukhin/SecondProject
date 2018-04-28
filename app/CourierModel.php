<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CourierModel extends Model
{

    protected $fillable = ['TelBot', 'Telephone', 'Company', 'Name', 'Surname'];

    /**
     * @param null $key
     * @return mixed
     */
    public static function getCouriers($key = null)
    {
        // в переменную $settings записываем результат запроса в бд через тернарную операцию
        // если true, то обращаемся к этому же классу и сравниваем ключ 'key' с указанным каким-то конкретным ключем
        // поступающим в метод через переменную $key и добавляем метод first() чтобы вернуть одно значение
        // Если false то записываем все значения из таблицы через self::get()

        $settings = $key ? CourierModel::where('id', $key)->first() : self::get();

        return $settings;
    }

    /**
     * @param null $key
     * @return mixed
     */
    public static function getOneCourier($key = null)
    {

        // в переменную $settings записываем результат запроса в бд через тернарную операцию
        // если true, то обращаемся к этому же классу и сравниваем ключ 'key' с указанным каким-то конкретным ключем
        // поступающим в метод через переменную $key и добавляем метод first() чтобы вернуть одно значение
        // Если false то записываем все значения из таблицы через self::get()

        $settings = CourierModel::where('TelBot', $key)->first();

        return $settings;
    }
}



