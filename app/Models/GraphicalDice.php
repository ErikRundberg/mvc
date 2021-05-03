<?php

declare(strict_types=1);

namespace App\Models;

/**
 * GraphicalDice Functions.
 */
class GraphicalDice extends Dice
{
    private $class = [];

    public function __construct($sides = 6)
    {
        parent::__construct($sides);
    }

    public function makeDie(): void
    {
        $this->class[] = "dice-" . $this->getLastRoll();
    }

    public function getClass(): array
    {
        return $this->class;
    }
}
