@extends('backend.layouts.app')

@section('content')
    <h2>Create new order</h2>

    <form method="POST" action="{{ route('admin.createOneOrder') }}" class="form-order">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="{{ $result['id'] or '' }}">

        <div class="form-group">
            <label for="mark" class="lab">Курьер<br/>
                <input type="text" class="form-control" id="TelBot" name="TelBot" readonly placeholder="Номер курьера"
                       value="{{ $result['TelBot']  or '' }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Телефон клиента<br/>
                <input type="text" class="form-control" id="TelClient" name="TelClient" placeholder="Телефон клиента"
                       value="{{ $result['TelClient']  or '' }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Адрес<br/>
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Адрес"
                       value="{{ $result['Address']  or '' }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Номер внутренний<br/>
                <input type="text" class="form-control" id="NumberOrder" name="NumberOrder" placeholder="Номер внутренний"
                       value="{{ $result['NumberOrder']  or '' }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Статус<br/>
                <select class="form-control" name="Status">
                    <option class="form-control" value="Wait">Wait</option>
                    <option class="form-control" value="InWork">In Work</option>
                    <option class="form-control" value="Delivered">Delivered</option>
                    <option class="form-control" value="Revoke">Revoke</option>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Время доставки<br/>
                <input type="time" class="form-control" id="TimeDelivery"
                       name="TimeDelivery" list="time-list" value="{{ $result['TimeDelivery']  or '' }}">
            </label>
        </div>

        <button type="submit" class="btn btn-default">Отправить</button>

    </form>


@endsection