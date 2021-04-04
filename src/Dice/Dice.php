<?php

declare(strict_types=1);

namespace Erru\Dice;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Dice Functions.
 */
class Dice
{

    private $sides;
    private $roll;

    public function __construct($sides)
    {
        $this->sides = $sides;
    }

    public function roll(): void
    {
        $this->roll = rand(1, $this->sides);
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
