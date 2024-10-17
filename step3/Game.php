<?php

namespace TrumpWar\Step3;

class Game
{
    public const PLAYER_1 = 1;
    public const PLAYER_2 = 2;
    public const DRAW = 2;
    public const GAME_END_CARDS_NUM = 0;
    public const WINNER = 0;

    public function __construct(private int $playerNum)
    {
    }

    public function dealCards(array $players, Deck $deck)
    {
        $playerNum = 1;
        $chunkNum = 0;
        $chunkArray = $deck->chunkDeck($players);
        foreach ($chunkArray as $playerDeck) {
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
        while (true) {
            //ここからドローの処理までを関数にしたいよね
            Message::war();
            $playersHand = [];
            $playerNumber = 1;
            $this->playerDrawOneCard($players);
            foreach ($players as $player) {
                Message::currentHand($player);
                $playersHand[$playerNumber] = $player->getCurrentHand();
                $playerNumber++;
            }
            $result = Judge::judge($playersHand);

            if (count($result) >= self::DRAW) {
                Message::draw();
                foreach ($playersHand as $playerHand) {
                    $drawTempArray[] = $playerHand;
                }
            } else {
                //ドロー配列にカードが存在しているなら$playersHandに入れる処理
                if (!(empty($drawTempArray))) {
                    foreach ($drawTempArray as $drawTempCard) {
                        $playersHand[] = $drawTempCard;
                    }
                    unset($drawTempArray);
                }
                $winPlayerNumber = $result[self::WINNER];
                $players[$winPlayerNumber]->addWinGetCards($playersHand);
                Message::winner($winPlayerNumber, $players);
                Message::playerGetCards($winPlayerNumber, $players, $playersHand);
            }

            //checkPlayerCard($players)って関数にしたいね
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


    public function createPlayer(): array
    {
        $players = [];
        for ($i = 1; $i <= $this->playerNum; $i++) {
            echo 'プレイヤー' . $i . 'の名前を入力してください: ';
            $playerName = trim(fgets(STDIN));
            $players[$i] = new Player($i, $playerName);
        }

        return $players;
    }
}
