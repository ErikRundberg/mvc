@extends("layouts.default")
@section("content")
<h1>{{ $header }}</h1>
<p>{{ $message }}</p>
<form method="post" action="{{ $action }}">
    @csrf
    <p>
        <input type="text" name="content" placeholder="Enter a value and see it in the resultpage.">
    </p>

    <p>
        <input type="submit" value="Press me">
    </p>

@if ($output !== null)
    <p>
        <output>You have sent the value of:<br>'<?= htmlentities($output) ?>'</output>
    </p>
@endif
</form>
@stop
