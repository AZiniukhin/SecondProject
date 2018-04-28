@extends('backend.layouts.app')

@section('content')

    <h2>Couriers</h2>

    {{--<p>{{ $ass }}</p>--}}

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">№</th>
            <th class="text-center">Номер в Telegram</th>
            <th class="text-center">Компания</th>
            <th class="text-center">Имя</th>
            <th class="text-center">Фамилия</th>
            <th class="text-center">Телефон</th>
            <th class="text-center"></th>
            {{--<th>id</th>--}}
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
                    {{--<td>{{ $data['id'] }}</td>--}}
                    <td>
                        {{--<a href="{{ route('admin.showOneCourier', $data['id']) }}" class="btn btn-primary">--}}
                            {{--<i class="glyphicon glyphicon-eye-open"></i>--}}
                        {{--</a>--}}
                        <a href="{{ route('admin.editCourier', $data['id']) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="{{ route('admin.deleteCourier', $data['id']) }}" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection


