<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$diceAmt = $diceAmt ?? null;
$win = $win ?? 0;
$lose = $lose ?? 0;
$dices = $dices ?? null;
$sum = $sum ?? 0;
$compSum = $compSum ?? 0;
?>

<h1><?= $header ?></h1>
<hr>

<?php if ($diceAmt == null) : ?>
<form action="game-21" method="post">
    <p>Amount of dice</p>
    <input type="radio" name="diceAmt" value="1" required>
    <label for="1">1</label>
    <input type="radio" name="diceAmt" value="2">
    <label for="2">2</label><br><br>
    <button type="submit" name="start">Start</button>
</form>

<hr>

<p>Player Wins: <?= $win ?></p>
<p>Player Losses: <?= $lose ?></p>

<form method="post">
    <button type="submit" name="reset">Reset score</button>
</form>
<?php endif; ?>


<?php if ($dices !== null) : ?>
<p class="dice-utf8">
    <?php foreach ($dices as $value) : ?>
    <i class="<?= $value[0] ?>"></i>
    <?php endforeach; ?>
</p>
<p>Sum: <?= $sum ?></p>
<p>Computer sum: <?= $compSum ?></p>
<h1><?= $message ?></h1>
    <?php if ($message !== "Player lost!") : ?>
<form method="post">
    <button type="submit" name"roll">Roll</button>
</form>
<br>
<form method="post">
    <button type="submit" name="stop">Stop</button>
</form>
<br>
    <?php endif; ?>

<form method="post">
    <button type="submit" name="back">Return</button>
</form>
<?php endif; ?>
