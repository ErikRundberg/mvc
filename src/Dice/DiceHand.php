<?php

declare(strict_types=1);

namespace Erru\Dice;

/**
 * DiceHand Functions.
 */

class DiceHand extends GraphicalDice
{

    private $dices = [];
    private $allClasses = [];
    private $sum;

    public function __construct($dices)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new GraphicalDice();
        }
    }

    public function rollAll(): void
    {
        foreach ($this->dices as $dice) {
            $dice->roll();
            $this->sum += $dice->getLastRoll();
            $dice->makeDie();
            $this->allClasses[] = $dice->getClass();
        }
    }

    public function getResult(): array
    {
        return $this->allClasses;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function overLimit(): string
    {
        if ($_SESSION["sum"] > 21) {
            return "You lost!";
        }
        return "";
    }

    public function computerRoll(): int
    {
        while ($this->sum < $_SESSION["sum"] and $this->sum < 21) {
            $this->rollAll();
        }
        return $this->sum;
    }

    public function calculateWin(): string
    {
        if ($_SESSION["sum"] > 21) {
            $_SESSION["lose"] += 1;
            return "Player lost!";
        } else if ($_SESSION["compSum"] == 0) {
            return "";
        } elseif ($_SESSION["compSum"] > 21) {
            $_SESSION["win"] += 1;
            return "Player won!";
        }
        $_SESSION["lose"] += 1;
        return "Player lost!";
    }
}
