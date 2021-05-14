<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav class="center">
            <a href="<?= url("/") ?>">Home</a> |
            <a href="<?= url("/session") ?>">Session</a> |
            <a href="<?= url("/debug") ?>">Debug</a> |
            <a href="<?= url("/form/view") ?>">Form</a> |
            <a href="<?= url("/yatzy") ?>">Yatzy</a> |
            <a href="<?= url("/highscores") ?>">Highscore</a> |
            <a href="<?= url("/books") ?>">Books</a>
        </nav>
    </header>
    <main>
