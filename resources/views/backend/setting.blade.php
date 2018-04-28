@extends('backend.layouts.app')

@section('content')

    @if(Session::has('status'))
        <div class="alert alert-info">
            <span>{{ Session::get('status') }}</span>
        </div>
    @endif

    {{-- Это единственный файл который отображает список настроек и сохраняет их --}}
    {{-- Данная форма предназначена для быстрой смены Url-а по которому будет стучаться Telegram Bot --}}

        <form action="{{ route('admin.setting.storeSetting') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">

                {{-- Настройка в которой хранится Url для работы WebHook, Url по которому должне обращаться сервер Telegramm
                     для того чтобы мой бот мог отвечать на запросы в телеграм-чат --}}
                <label>Url callback для TelBot</label>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Действие <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            {{-- Вставить Url в поле с использованем js --}}
                            <li><a href="#"
                                   onclick="document.getElementById('url_callback_bot').value = '{{ url('') }}'">Вставить
                                    url</a></li>
                            {{-- Отправить Url на сервер Telegram --}}
                            <li><a href="#"
                                   onclick="event.preventDefault(); document.getElementById('setwebhook').submit();">Отправить
                                    url</a></li>
                            {{-- Получить информацию о настройке WebHook --}}
                            <li><a href="#"
                                   onclick="event.preventDefault(); document.getElementById('getwebhookinfo').submit();">Получить
                                    информацию</a></li>
                        </ul>
                    </div>
                    {{-- Непосредственно поле с настройкой, добавляем id полученное из getElementById() из js выше,
                         имя, которое должно быть уникальным и значение --}}
                    <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot"
                           value="{{ $url_callback_bot or '' }}">
                </div>
            </div>


            {{--<div class="form-group">--}}
                {{--<label>Name for site</label>--}}
                    {{--<input type="text" class="form-control" name="name_for_site" value="{{ $name_for_site or '' }}">--}}
            {{--</div>--}}


            {{-- Кнопка для отправки формы на Route --}}
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>

        <form id="setwebhook" action="{{ route('admin.setting.setWebHook') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="url" value="{{ $url_callback_bot or '' }}">
        </form>

        <form id="getwebhookinfo" action="{{ route('admin.setting.getWebHookInfo') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>


@endsection