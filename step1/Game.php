<?php

namespace TrumpWar\Step1;

class Game
{
    public const PLAYER_1 = 1;
    public const PLAYER_2 = 2;
    public const DRAW = 0;

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

    public function playerDrawOneCard(array $players)
    {
        foreach ($players as $player) {
            $player->setCurrentHand($player->drawOneCard());
        }
    }

    public function battle(array $players)
    {
        //勝負の開始
        Message::war();
        $this->playerDrawOneCard($players);
        foreach ($players as $player) {
            Message::currentHand($player);
        }
        $result = Judge::judge($players[self::PLAYER_1]->getCurrentHand(), $players[self::PLAYER_2]->getCurrentHand());

        while ($result == self::DRAW) {
            Message::war();
            Message::draw();
            $this->playerDrawOneCard($players);
            foreach ($players as $player) {
                Message::currentHand($player);
            }
            $result = Judge::judge($players[self::PLAYER_1]->getCurrentHand(), $players[self::PLAYER_2]->getCurrentHand());
        }

        return $result;
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
