<?php

namespace TrumpWar\Step3;

class Message
{
    public static function currentHand(Player $player): void
    {
        $playerNumber = $player->getNumber();
        $playerCurrentHand = $player->getCurrentHand();
        $cardSuit = $playerCurrentHand->getSuit();
        $cardNumber = $playerCurrentHand->getNumber();
        $playerName = $player->getName();

        if ($cardSuit === 'J') {
            echo $playerName . 'のカードはジョーカーです。' . PHP_EOL;
        } else {
            echo $playerName . 'のカードは' . Card::SUIT_NAME[$cardSuit] . 'の' . $cardNumber . 'です。' . PHP_EOL;
        }
    }

    public static function startWar(): void
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

    public static function winner(int $result, array $players): void
    {
        echo $players[$result]->getName() . 'が勝ちました。' . PHP_EOL;
    }

    public static function result(int $losePlayerNumber, array $players): void
    {
        $i = 1;
        $rank = 1;
        $playersTotalHands = [];
        echo $players[$losePlayerNumber]->getName() . 'の手札がなくなりました。' . PHP_EOL;
        foreach ($players as $player) {
            $playerDealedCards = $player->getPlayerCardsNum();
            $playerWinGetCards = $player->getPlayerWinGetCardsNum();
            $playerTotalCards = $playerWinGetCards + $playerDealedCards;
            $playersTotalHands[$player->getName()] = $playerTotalCards;
            $i++;
            echo $player->getName() . 'の手札の枚数は' . $playerTotalCards . 'です。';
        }

        echo PHP_EOL;
        arsort($playersTotalHands);
        $playersCount = count($players);
        foreach ($playersTotalHands as $number => $playerTotalHands) {
            if ($rank < $playersCount) {
                echo $number . 'が' . $rank . '位、';
            } else {
                echo $number . 'が' . $rank . '位です。' . PHP_EOL;
            }
            $rank++;
        }
    }

    public static function playerGetCards(int $winPlayerNumber, array $players, array $playersHand): void
    {
        $cardsNum = count($playersHand);
        $playerName = $players[$winPlayerNumber]->getName();
        echo $playerName . 'はカードを' . $cardsNum . '枚もらいました。' . PHP_EOL;
    }
}
