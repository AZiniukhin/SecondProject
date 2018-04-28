<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class yakitoryOrder extends Model
{
    //
    protected $fillable = ['TelBot', 'TelClient', 'Address', 'NumberOrder', 'Status', 'TimeDelivery'];

    /**
     * @param null $key
     * @return mixed
     */
    public static function getOrders($key = null)
    {
        // в переменную $settings записываем результат запроса в бд через тернарную операцию
        // если true, то обращаемся к этому же классу и сравниваем ключ 'key' с указанным каким-то конкретным ключем
        // поступающим в метод через переменную $key и добавляем метод first() чтобы вернуть одно значение
        // Если false то записываем все значения из таблицы через self::get()

        $settings = $key ? yakitoryOrder::where('id', $key)->first() : self::get();

        //Log::info($settings);

        return $settings;
    }

    /**
     * @param $data
     */
    public static function setOrder($data)
    {

        $order = yakitoryOrder::create($data);

        $order->save();
    }


    /**
     *
     * Вот так правильнее будет добавлять информацию о времени доставки заказа
     * разбирая ее из двух чисел на уровне view и собирая перед загрузкой в бд
     * @param $attr
     * @return string
     */
    public function setTimeDeliveryField($attr)
    {
        return $attr['TimeDelivery']['hours'] . ':' . $attr['TimeDelivery']['minutes'];
    }
}

