@extends('layouts.default')
@section("content")
@empty($highscores)
    <h2>Inga highscores</h2>
@endempty

@if (!empty($highscores))
<h1>Highscore</h1>
<table class="db-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Poäng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($highscores as $highscore)
            <tr>
                <td>{{ $highscore->id }}</td>
                <td>{{ $highscore->score }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@stop
