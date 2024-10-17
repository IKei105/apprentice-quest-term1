<?php

namespace TrumpWar\Step2;

class Game
{
    public const PLAYER_1 = 1;
    public const PLAYER_2 = 2;
    public const DRAW = 0;
    public const GAME_END_CARDS_NUM = 0;

    public function dealCards(array $players, Deck $deck)
    {
        $playerNum = 1;
        $chunkNum = 0;
        $chunkDeck = $deck->chunkDeck(26);

        foreach ($chunkDeck as $playerDeck) {
            $players[$playerNum]->setDealedCard($playerDeck);
            $playerNum++;
            $chunkNum++;
        }
    }

    //プレイヤーが山札のカードを1枚引き$player->currentHandに格納する処理
    public function playerDrawOneCard(array $players)
    {
        foreach ($players as $player) {
            $player->setCurrentHand($player->drawOneCard());
        }
    }

    public function battle(array $players)
    {
        //勝負の開始
        $drawTempArray = [];
        //ここから下をどちらかの手札が0になるまでループする
        while ($players[self::PLAYER_1]->getPlayerCardsNum() > 0 && $players[self::PLAYER_2]->getPlayerCardsNum() > 0) {
            Message::war();
            $playersHand = [];
            $playerNumber = 1;
            $this->playerDrawOneCard($players);
            foreach ($players as $player) {
                Message::currentHand($player);
                $playersHand[$playerNumber] = $player->getCurrentHand();
                $playerNumber++;
            }
            $result = Judge::judge($playersHand[self::PLAYER_1], $playersHand[self::PLAYER_2]);

            //ドローだったらもう一度対戦、
            if ($result == $players[self::PLAYER_1]->getNumber() or $result == $players[self::PLAYER_2]->getNumber()) {
                //ドロー配列にカードが存在しているなら$playersHandに入れる処理
                if (!(empty($drawTempArray))) {
                    foreach ($drawTempArray as $drawTempCard) {
                        $playersHand[] = $drawTempCard;
                    }
                    unset($drawTempArray);
                }
                //勝って手に入れたカードを格納する処理
                $players[$result]->addWinGetCards($playersHand);
                Message::winner($result, $players);
                Message::playerGetCards($result, $players, $playersHand);
            } elseif ($result === self::DRAW) {
                Message::draw();
                //drawTempArrayに値が存在しないなら$playerHandsの値をdrawTempArrayに入れようね
                foreach ($playersHand as $playerHand) {
                    $drawTempArray[] = $playerHand;
                }
            }

            foreach ($players as $player) {
                if ($player->getPlayerCardsNum() === 0 and $player->getPlayerWinGetCardsNum() === 0) {
                    $num = $player->getNumber();
                    return $player->getNumber();
                } elseif ($player->getPlayerCardsNum() === 0) {
                    $player->shuffleWinGetCards();
                    $player->setWinGetCardsToDealedCards();
                }
            }
        }
    }

    public static function createPlayer(): array
    {
        $players = [];
        for ($i = 1; $i <= 2; $i++) {
            $players[$i] = new Player($i);
        }

        return $players;
    }
}
