<?php

declare(strict_types=1);

namespace Erru\Dice;

/**
 * GraphicalDice Functions.
 */
class GraphicalDice extends Dice
{
    private $class = [];

    public function __construct()
    {
        parent::__construct(6);
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
