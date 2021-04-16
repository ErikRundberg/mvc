<?php

declare(strict_types=1);

namespace Erru\Dice;

/**
 * Dice Functions.
 */
class DiceFunctions
{
    public function checkPosts(): void
    {
        $gameSessionKeys = ["message", "win", "lose", "dices", "sum", "compSum", "diceAmt"];
        foreach ($gameSessionKeys as $key) {
            if (!isset($_SESSION[$key])) {
                $_SESSION[$key] = null;
            };
        }
        $this->postRoll();
        $this->postStart();
        $this->postReset();
        $this->postStop();
        $this->postBack();
    }

    public function postStart(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["start"])) {
            $_SESSION["diceAmt"] = $_POST["diceAmt"];
            $_POST["roll"] = "pass";
            $this->postRoll();
        };
    }

    public function forceRoll(): void
    {
        $diceHand = new DiceHand($_SESSION["diceAmt"]);
        $diceHand->rollAll();
        $_SESSION["dices"] = $diceHand->getResult();
        $_SESSION["sum"] += $diceHand->getSum();
        $_SESSION["message"] = $diceHand->calculateWin();
    }

    public function postReset(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["reset"])) {
            $_SESSION["wins"] = null;
            $_SESSION["lose"] = null;
        };
    }

    public function postRoll(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["roll"])) {
            $diceHand = new DiceHand($_SESSION["diceAmt"]);
            $diceHand->rollAll();
            $_SESSION["dices"] = $diceHand->getResult();
            $_SESSION["sum"] += $diceHand->getSum();
            $_SESSION["message"] = $diceHand->calculateWin();
        };
    }

    public function postStop(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["stop"])) {
            $diceHand = new DiceHand($_SESSION["diceAmt"]);
            $_SESSION["compSum"] = $diceHand->computerRoll();
            $_SESSION["message"] = $diceHand->calculateWin();
        };
    }

    public function postBack(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["back"])) {
            $_SESSION["message"] = null;
            $_SESSION["diceAmt"] = null;
            $_SESSION["sum"] = null;
            $_SESSION["compSum"] = null;
            $_SESSION["dices"] = null;
        };
    }
}
