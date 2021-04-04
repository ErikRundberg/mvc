<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use Erru\Dice\Dice;
use Erru\Dice\GraphicalDice;
use Erru\Dice\DiceHand;

// $dice = new Dice(3);
//
// $dice->roll();
// echo $dice->getLastRoll();
//
// $gdice = new GraphicalDice();
//
// echo "\n";
//
// $gdice->roll();
// echo $gdice->getLastRoll();
//
// echo "\n";
//
// var_dump($gdice->makeDie());

$dh = new DiceHand(3);
$dh->rollAll();
echo $dh->getSum() . "\n";
var_dump($dh->getResult());
