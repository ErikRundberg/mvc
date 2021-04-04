<?php

/**
 * Computer side of dice game.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$sum = $sum ?? null;
$compSum = $compSum ?? null;

?><h1><?= $header ?></h1>
<p>Sum: <?= $sum ?></p>
<p>Computer sum: <?= $compSum ?></p>
<h1><?= $message ?></h1>

<form action="back" method="post">
    <button type="submit">Return</button>
</form>
