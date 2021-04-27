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
    private $allThrows = [];
    private $sum;

    public function __construct($dices, $sides = 6)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new GraphicalDice($sides);
        }
    }

    public function rollAll(): void
    {
        foreach ($this->dices as $dice) {
            $dice->roll();
            $this->sum += $dice->getLastRoll();
            $dice->makeDie();
            $this->allClasses[] = $dice->getClass();
            $this->allThrows[] = $dice->getLastRoll();
        }
    }

    public function getResult(): array
    {
        return $this->allClasses;
    }

    public function getThrows(): array
    {
        return $this->allThrows;
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

    public function getKeptResult($dices): array
    {
        $newThrow = $this->getResult();
        $this->allThrows = [];
        foreach ($dices as $dice) {
            $newThrow[] = [$dice];
        }
        $newArray = array_slice($newThrow, -5);
        foreach ($newArray as $value) {
            $this->allThrows[] = substr($value[0], -1);
        }
        return $newArray;
    }
}
