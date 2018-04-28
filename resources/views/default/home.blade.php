@extends('backend.layouts.app')

@section('content')

{{--<div class="container">--}}

    <div id="pic">
        <img src="{{asset('images/porter.png')}}" class="pic-item pic-item00">
        <img src="{{asset('images/Kurerskaya-dostavka-po-Batumi.png')}}" class="pic-item pic-item01">
        <img src="{{asset('images/OkFindMe2.png')}}" class="pic-item pic-item02">
        <img src="{{asset('images/bunch-of-boxes.png')}}" class="pic-item pic-item03">
    </div>

{{--</div>--}}

<script>
var tok = "{{csrf_token() }}";
</script>
<script src="{{secure_asset('js/scriptHome.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE&callback=initMap   ">
</script>



@endsection










