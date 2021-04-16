<?php

/**
 * Yatzy view template
 */

declare(strict_types=1);

$header = $header ?? "Yatzy";
$message = $message ?? null;
$dice = $dice ?? [];
$table = $table ?? [];
?>

<div class="center">
        <h1><?= $header ?></h1>
        <p><?= $message ?></p>

        <!-- debug -->
        <?php if(isset($_SESSION["d"])): ?>
        <p><?php var_dump($_SESSION["d"]); ?></p>
        <?php endif; ?>

        <!-- Start game -->
        <?php if (!isset($_SESSION["yatzyRound"])): ?>
            <form method="post">
                <button type="submit" name="startYatzy">Start</button>
            </form>
        <?php endif; ?>
</div>

<div class="flex">
    <?php if ($_SESSION["yatzyRound"] <= 6): ?>
    <div class="center big">
    <!-- Roll die -->
    <?php if (isset($_SESSION["yatzyRound"]) and $_SESSION["roll"] != 3): ?>
        <p>Roll: <?= $_SESSION["roll"] ?>/3</p>
        <form method="post">
            <button type="submit" name="rollYatzy">Roll</button>
        </form>
    <?php endif; ?>

    <!-- Keep die -->
    <?php if (isset($_SESSION["yatzyDice"])) : ?>
    <form method="post">
        <div class="flex">
            <?php foreach($dice as $die): ?>
            <div>
                <p class="dice-utf8">
                    <i class="<?= $die[0] ?>"></i>
                </p>
                <?php if ($_SESSION["roll"] != 3): ?>
                <input type="checkbox" name="diceArray[]" value="<?= $die[0] ?>">
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <br>
        <?php if ($_SESSION["roll"] != 3): ?>
        <button type="submit" name="keepDice">Keep</button>
        <?php endif; ?>
    </form>
    <!-- Next round button -->
    <?php if (isset($_SESSION["yatzyDice"])): ?>
    <br>
    <form class="flex" method="post">
        <button type="submit" name="nextRound">Stop</button>
    </form>
    <br>
    <?php endif; ?>
    <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Score table -->
    <div class="center">
        <?php if (isset($_SESSION["DiceHand"])): ?>
        <div class="flex">
            <table class="center right-border">
                <thead>
                    <th>Round</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    <?php foreach (range(0, 8) as $index): ?>
                    <tr>
                            <td><?= $table[0][$index] ?></td>
                            <td><?= $table[1][$index] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
