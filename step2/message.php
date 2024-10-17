<?php

namespace TrumpWar\Step2;

class Message
{
    public static function currentHand(Player $player)
    {
        $playerNumber = $player->getNumber();
        $playerCurrentHand = $player->getCurrentHand();
        $cardSuit = $playerCurrentHand->getSuit();
        $cardNumber = $playerCurrentHand->getNumber();

        echo 'プレイヤー' . $playerNumber . 'のカードは' . Card::SUIT_NAME[$cardSuit] . 'の' . $cardNumber . 'です。' . PHP_EOL;
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

    public static function winner(int $result, array $players): void
    {
        echo 'プレイヤー' . $players[$result]->getNumber() . 'が勝ちました。' . PHP_EOL;
    }

    public static function result(int $losePlayerNumber, array $players)
    {
        $i = 1;
        $rank = 1;
        $playersTotalHands = [];
        echo $players[$losePlayerNumber]->getNumber() . 'の手札がなくなりました。' . PHP_EOL;
        foreach ($players as $player) {
            $playerDealedCards = $player->getPlayerCardsNum();
            $playerWinGetCards = $player->getPlayerWinGetCardsNum();
            $playerTotalCards = $playerWinGetCards + $playerDealedCards;
            $playersTotalHands[$player->getNumber()] = $playerTotalCards;
            $i++;
            echo 'プレイヤー' . $player->getNumber() . 'の手札の枚数は' . $playerTotalCards . 'です。';
        }
        echo PHP_EOL;
        arsort($playersTotalHands);
        $playersCount = count($players);
        foreach ($playersTotalHands as $number => $playerTotalHands) {
            if ($rank < $playersCount) {
                echo 'プレイヤー' . $number . 'が' . $rank . '位、';
            } else {
                echo 'プレイヤー' . $number . 'が' . $rank . '位です。';
            }
            $rank++;
        }
    }

    //プレイヤー1はカードを2枚もらいましたってのを実装しよう
    public static function playerGetCards(int $result, array $players, array $playersHand): void
    {
        $cardsNum = count($playersHand);
        $playerNumber = $players[$result]->getNumber();
        echo 'プレイヤー' . $playerNumber . 'はカードを' . $cardsNum . '枚もらいました。' . PHP_EOL;
    }
}
