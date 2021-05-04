<?php

declare(strict_types=1);

namespace App\Models;

use Request;
/**
 * Yatzy Functions.
 */

class YatzyFunctions
{
    public function checkPosts(): void
    {
        $this->startYatzy();
        $this->keepDice();
        $this->rollDice();
        $this->nextRound();
        $this->endGame();
    }

    public function startYatzy(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("startYatzy")) {
            session(["yatzyRound" => 1]);
            session(["DiceHand" => null]);
            session(["roll" => 0]);
            $this->setupTable();
        }
    }

    public function rollDice(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("rollYatzy")) {
            $roll = (session("roll") + 1) ?? 1;
            session(["roll" => $roll]);
            $diceHand = new DiceHand(5);
            $diceHand->rollAll();
            session(["throws" => $diceHand->getThrows()]);
            session(["yatzyDice" => $diceHand->getResult()]);
        }
    }

    private function forceRoll(): void
    {
        $roll = (session("roll") + 1) ?? 1;
        session(["roll" => $roll]);
        $diceHand = new DiceHand(5);
        $diceHand->rollAll();
        session(["throws" => $diceHand->getThrows()]);
        session(["yatzyDice" => $diceHand->getResult()]);
    }

    public function keepDice(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("keepDice")) {
            $keptDice = [];
            if (!Request::filled("diceArray")) {
                $this->forceRoll();
                return;
            }
            foreach (Request::input("diceArray") as $dice) {
                $keptDice[] = $dice;
            }
            $this->keepRoll($keptDice);
        }
    }

    private function keepRoll($keptDice = [0]): void
    {
        $roll = (session("roll") + 1) ?? 1;
        session(["roll" => $roll]);
        $diceHand = new DiceHand(5);
        $diceHand->rollAll();
        session(["throws" => $diceHand->getThrows()]);
        session(["yatzyDice" => $diceHand->getKeptResult($keptDice)]);
    }

    public function nextRound(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("nextRound")) {
            $throws = session("throws");
            $round = session("yatzyRound") - 1;
            $sum = 0;
            foreach ($throws as $throw) {
                if ($throw == $round + 1) {
                    $sum += $throw;
                }
            }
            session()->push("tableScore", $sum);
            session(["yatzyRound" => $round + 2]);
            session(["roll" => 0]);
            session(["yatzyDice" => null]);
        }
    }

    public function setupTable(): void
    {
        session(["tableName" => ["1", "2", "3", "4", "5", "6", "Sum", "Bonus", "Total"]]);
    }

    public function getRound(): ?string
    {
        if (null != session("yatzyRound")) {
            if (session("yatzyRound") > 6) {
                return "Game Finished!";
            }
            return "Round: " . session("yatzyRound");
        }
        return null;
    }

    public function endGame(): void
    {
        if (session("yatzyRound") == 7) {
            $sum = 0;
            session(["yatzyDice" => null]);
            for ($i = 0; $i < 6; $i++) {
                $sum += session("tableScore"[$i]);
            }
            session()->push("tableScore", $sum);
            session(["tableScore"[7] => 0]);
            if ($sum >= 50) {
                session()->push("tableScore", 50);
            } else {
                session()->push("tableScore", 0);
            }
            session()->push("tableScore", $sum + session("tableScore"[7]));
        }
    }
}
