@extends('backend.layouts.app')

@section('content')

    <h2>Orders</h2>

    <a href="{{ route('admin.createOrder') }}" class="btn btn-new-order">Новый заказ</a>
    <p><br /></p>



    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">№</th>
            <th class="text-center">Номер в<br> Telegram</th>
            <th class="text-center">Телефон<br> клиента</th>
            <th class="text-center">Адрес</th>
            <th class="text-center">Внутренний<br> номер</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Время<br> доставки</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($result as $data)
            <tr>
                @foreach($data as $key => $value)
                    @if($key != 'created_at' && $key != 'updated_at')
                        <td>{{ $value }}</td>
                    @endif
                @endforeach

                <td>
                    <a href="{{ route('admin.showOneOrder', $data['id']) }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                    <a href="{{ route('admin.editOrder', $data['id']) }}" class="btn btn-warning">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="{{ route('admin.deleteOrder', $data['id']) }}" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection