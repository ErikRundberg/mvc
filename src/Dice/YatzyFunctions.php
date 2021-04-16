<?php

declare(strict_types=1);

namespace Erru\Dice;

/**
 * Yatzy Functions.
 */
class YatzyFunctions
{
    function checkPosts(): void
    {
        $sessionKeys = ["yatzyDice", "yatzyRound", "roll", "diceArray", "tableData", "table"];
        foreach ($sessionKeys as $key) {
            if (!isset($_SESSION[$key])) {
                $_SESSION[$key] = null;
            }
        }
        $this->startYatzy();
        $this->keepDice();
        $this->rollDice();
        $this->nextRound();
        $this->endGame();
    }

    function startYatzy(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["startYatzy"])) {
            $_SESSION["yatzyRound"] = 1;
            $_SESSION["DiceHand"] = null;
            $_SESSION["roll"] = 0;
            $this->setupTable();
        }
    }

    function rollDice(): void
    {
        if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["rollYatzy"])) {
            $_SESSION["roll"] += 1 ?? 1;
            $_SESSION["DiceHand"] = new DiceHand(5);
            $_SESSION["DiceHand"]->rollAll();
            $_SESSION["yatzyDice"] = $_SESSION["DiceHand"]->getResult();
        }
    }

    function forceRoll(): void
    {
        $_SESSION["roll"] += 1 ?? 1;
        $_SESSION["DiceHand"] = new DiceHand(5);
        $_SESSION["DiceHand"]->rollAll();
        $_SESSION["yatzyDice"] = $_SESSION["DiceHand"]->getResult();
    }

    function keepDice(): void
    {
        if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["keepDice"])) {
            if (empty($_POST["diceArray"])) {
                $this->forceRoll();
            } else {
                $keptDice = [];
                foreach ($_POST["diceArray"] as $dice) {
                    $keptDice[] = $dice;
                }
                $this->keepRoll($keptDice);
            }
        }
    }

    function keepRoll($keptDice=[0]): void
    {
        $_SESSION["roll"] += 1 ?? 1;
        $_SESSION["DiceHand"] = new DiceHand(5);
        $_SESSION["DiceHand"]->rollAll();
        $_SESSION["yatzyDice"] = $_SESSION["DiceHand"]->getKeptResult($keptDice);

    }

    function nextRound(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["nextRound"])) {
            $round = $_SESSION["yatzyRound"]-1;
            $sum = 0;
            $throws = $_SESSION["DiceHand"]->getThrows();
            foreach ($throws as $throw) {
                if ($throw == $round+1) {
                    $sum += $throw;
                }
            }
            $_SESSION["tableData"][$round] = $sum;
            $_SESSION["yatzyRound"] += 1;
            $_SESSION["roll"] = 0;
            $_SESSION["yatzyDice"] = null;
        }
    }

    function setupTable(): void
    {
        $_SESSION["table"] = ["1", "2", "3", "4", "5", "6", "Sum", "Bonus", "Total"];
        foreach (range(0, 8) as $index) {
            $_SESSION["tableData"][$index] = "";
        }
    }

    function getRound(): ?string
    {
        if (isset($_SESSION["yatzyRound"])) {
            if ($_SESSION["yatzyRound"] > 6) {
                return "Game Finished!";
            }
            return "Round: " . $_SESSION["yatzyRound"];
        }
        return null;
    }

    function endGame(): void
    {
        if ($_SESSION["yatzyRound"] == 7) {
            $sum = 0;
            $_SESSION["yatzyDice"] = null;
            for ($i=0; $i < 6; $i++) {
                $sum += $_SESSION["tableData"][$i];
            }
            $_SESSION["tableData"][6] = $sum;
            if ($sum >= 50) {
                $_SESSION["tableData"][7] = 50;
            } else {
                $_SESSION["tableData"][7] = 0;
            }
            $_SESSION["tableData"][8] = $sum + $_SESSION["tableData"][7];
        }
    }

}

// checkbox value = dice.value (maybe position?)
