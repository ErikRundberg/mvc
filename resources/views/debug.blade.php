@extends("layouts.default")
@section("content")
    @php
    echo "<h1>Debug details</h1>";

    var_dump($_SERVER);
    @endphp
@stop
