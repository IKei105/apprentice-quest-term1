<?php

namespace TrumpWar\Step1;

class Message
{
    public static function currentHand(Player $player)
    {
        $playerNumber = $player->getNumber();
        $playerCurrentHand = $player->getCurrentHand();
        $cardSuit = $playerCurrentHand->getSuit();
        $cardNumber = $playerCurrentHand->getNumber();

        echo 'プレイヤー' . $playerNumber . 'のカードは' . $cardSuit . 'の' . $cardNumber . 'です。' . PHP_EOL;
    }

    public static function startWar()
    {
        echo '戦争を開始します。' . PHP_EOL;
    }
    public static function war(): void
    {
        echo '戦争！' . PHP_EOL;
    }

    public static function dealCards(): void
    {
        echo 'カードが配られました';
    }

    public static function draw(): void
    {
        echo '引き分け！' . PHP_EOL;
    }

    public static function result($result): void
    {
        if ($result == Game::PLAYER_1) {
            echo 'プレイヤー1の勝利です。' . PHP_EOL;
        } elseif ($result == Game::PLAYER_2) {
            echo 'プレイヤー2の勝利です。' . PHP_EOL;
        }
    }
}
