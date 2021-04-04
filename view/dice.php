<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$win = $win ?? null;
$lose = $lose ?? null;

?><h1><?= $header ?></h1>

<hr>

<form action="game-21" method="post">
    <p>Amount of dice</p>
    <input type="radio" name="dice_amt" value="1" required>
    <label for="1">1</label>
    <input type="radio" name="dice_amt" value="2">
    <label for="2">2</label><br><br>
    <button type="submit" name="startGame">Start</button>
</form>

<hr>

<p>Player Wins: <?= $_SESSION["win"] ?></p>
<p>Player Losses: <?= $_SESSION["lose"] ?></p>


<form action="reset" method="post">
    <button type="submit">Reset score</button>
</form>
