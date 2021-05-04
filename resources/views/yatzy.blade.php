@extends("layouts.default")
@section("content")
<div class="center">
    <h1>{{ $header }}</h1>

        <!-- Start game -->
@if (null == (session("yatzyRound")))
    <form method="post">
        @csrf
        <button type="submit" name="startYatzy">Start</button>
    </form>
@endif
</div>

<div class="flex">
@if (session("yatzyRound") <= 6)
    <div class="center big">
    <!-- Roll die -->
@if (null != (session("yatzyRound") and session("roll") != 3))
        <p>Roll: {{ session("roll") }}/3</p>
        <form method="post">
            @csrf
            <button type="submit" name="rollYatzy">Roll</button>
        </form>
@endif

    <!-- Keep die -->
@if (null != (session("yatzyDice")))
    <form method="post">
        @csrf
        <div class="flex">
@foreach ($dice as $die)
            <div>
                <p class="dice-utf8">
                    <i class="{{ $die[0] }}"></i>
                </p>
@if (session("roll") != 3)
                <input type="checkbox" name="diceArray[]" value="{{ $die[0] }}">
@endif
            </div>
@endforeach
        </div>
        <br>
@if (session("roll") != 3)
        <button type="submit" name="keepDice">Keep</button>
@endif
    </form>
    <!-- Next round button -->
@if (null != (session("yatzyDice")))
    <br>
    <form class="flex" method="post">
        @csrf
        <button type="submit" name="nextRound">Stop</button>
    </form>
    <br>
@endif
@endif
    </div>
@endif

    <!-- Score table -->
    <div class="center">
@if (null != (session("yatzyRound")))
        <div class="flex">
            <table class="center right-border">
                <thead>
                    <th>Round</th>
                    <th>Score</th>
                </thead>
                <tbody>
@foreach (range(0, 8) as $index)
                    <tr>
                            <td>{{ $tableName[$index] }}</td>
                            <td>{{ $tableScore[$index] ?? "" }}</td>
@endforeach
                    </tr>

                </tbody>
            </table>
        </div>
@endif
    </div>
</div>
@stop
