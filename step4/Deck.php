<?php

namespace TrumpWar\Step4;

//デッキを生成するクラス
class Deck
{
    //カードインスタンスを格納する配列、53枚入り(ジョーカーはあり)
    private $cards = [];
    private const TOTAL_CARDS = 53;

    public function __construct()
    {
        foreach (['S','D','C','H'] as $suit) {
            foreach (array_keys(Card::CARD_STRENGTH) as $number) {
                $card = new Card($suit, $number);
                $this->cards[] = $card;
            }
        }
        $this->cards[] = new Card('J', '14');
    }

    //デッキをシャッフルする関数
    public function suffleCards(): void
    {
        shuffle($this->cards);
    }

    //デッキをプレーヤー人数分分割する関数
    public function chunkDeck(array $players)
    {
        $playersCount = count($players);
        $chunkArray = array_fill(0, $playersCount, []);

        foreach ($this->cards as $index => $card) {
            $chunkArray[$index % $playersCount][] = $card;
        }

        return $chunkArray;
    }

    //カードを返す関数
    public function getCards(): array
    {
        return $this->cards;
    }
}
