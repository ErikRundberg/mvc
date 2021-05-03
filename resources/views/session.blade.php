@extends("layouts.default")
@section("content")
    @php
    $url = url("/session/destroy");

    echo <<<EOD
    <h1>Session details</h1>
    <p>Here are some details on the session. Reload this page to see the counter increment itself.</p>
    <p>You may <a href="$url">destroy the session</a> if you like, good for dealing
    with trouble.</p>
    EOD;

    var_dump(session_name());
    var_dump(session()->all());
    @endphp
@stop
