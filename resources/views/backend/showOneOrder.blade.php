@extends('backend.layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Заказ</div>
        <div class="panel-body">
            <p>
                <strong>Внутренний номер заказа: </strong>{{ $result['NumberOrder'] }}
            </p>
            <p>
                <strong>Телефон клиента: </strong>{{ $result['TelClient'] }}
            </p>
            <p>
                <strong>Время доставки: </strong>{{ $result['TimeDelivery'] }}
            </p>
            <p>
                <strong>Курьер: </strong>{{ $result['TelBot'] }}
            </p>
            <p>
                <strong>Адрес: </strong>{{ $result['Address'] }}
            </p>
            <p>
                <strong>Статус: </strong>{{ $result['Status'] }}
            </p>
        </div>
    </div>



@endsection