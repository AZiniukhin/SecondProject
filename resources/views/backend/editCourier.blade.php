@extends('backend.layouts.app')

@section('content')

    <h2>Edit courier</h2>

    <form method="POST" action="{{ route('admin.storeCourier') }}" class="form-order">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="{{ $result['id'] }}">

        <div class="form-group">
            <label for="mark" class="lab">Компания<br/>
                <input type="text" class="form-control" id="company" name="Company" readonly placeholder="{{ $result['Company'] }}"
                       value="{{ $result['Company'] }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Имя<br/>
                <input type="text" class="form-control" id="name" name="Name" placeholder="{{ $result['Name'] }}"
                       value="{{ $result['Name'] }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Номер id в Telegram<br/>
                <input type="text" class="form-control" id="id-telegram" name="idTelegram" readonly placeholder="{{ $result['TelBot'] }}"
                       value="{{ $result['TelBot'] }}">
            </label>
        </div>

        <div class="form-group">
            <label for="mark" class="lab">Фамилия<br/>
                <input type="text" class="form-control" id="surname" name="Surname" placeholder="{{ $result['Surname'] }}"
                       value="{{ $result['Surname'] }}">
            </label>
        </div>

        <div class="form-group form-group-tel">
            <label for="mark" class="lab">Телефон<br/>
                <input type="text" class="form-control" id="telephone" name="Telephone" readonly placeholder="{{ $result['Telephone'] }}"
                       value="{{ $result['Telephone'] }}">
            </label>
        </div>
        <div class="form-group form-group-btn">
            <button type="submit" class="btn btn-default">Отправить</button>
        </div>
    </form>


@endsection