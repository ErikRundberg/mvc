@extends('layouts.default')
@section("content")
@empty($books)
    <h2>Inga böcker i databasen</h2>
@endempty

@if (!empty($books))
<h1>Böcker</h1>
<table>
    <thead>
        <tr>
            <th>Titel</th>
            <th>Författare</th>
            <th>ISBN</th>
            <th>Bild</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn }}</td>
                <td><img class="book-img" src="{{ $book->picture }}" alt="{{ $book->title }}"></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@stop
