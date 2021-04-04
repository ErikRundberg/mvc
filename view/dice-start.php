<?php

/**
 * Player view of dice game
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$dices = $dices ?? null;
$sum = $sum ?? null;

?><h1><?= $header ?></h1>
<p class="dice-utf8">
<?php foreach ($dices as $value) : ?>
    <i class="<?= $value[0] ?>"></i>
<?php endforeach; ?>
</p>
<p>Sum: <?= $sum ?></p>
<h1><?= $message ?></h1>

<form action="roll" method="post">
<button type="submit">Roll</button>
</form>
<br>
<form action="stop" method="post">
<button type="submit">Stop</button>
</form>
<br>
<form action="back" method="post">
    <button type="submit">Return</button>
</form>
