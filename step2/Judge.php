<?php

namespace TrumpWar\Step2;

class Judge
{
    public function __construct()
    {
    }

    public static function judge($player1Hand, $player2Hand)
    {
        $player1Strong = $player1Hand->getStrong();
        $player2Strong = $player2Hand->getStrong();

        if ($player1Strong > $player2Strong) {
            //プレイヤ1の勝ち
            return Game::PLAYER_1;
        } elseif ($player1Strong < $player2Strong) {
            //プレイヤ2の勝ち
            return Game::PLAYER_2;
        } else {
            //引き分け
            return Game::DRAW;
        }
    }
}
