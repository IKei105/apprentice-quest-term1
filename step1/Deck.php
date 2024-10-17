<?php

namespace TrumpWar\Step1;

class Deck
{
    //カードインスタンスを格納する配列、52枚入り(ジョーカーはなし)
    private $cards = [];

    public function __construct()
    {
        foreach (['S','D','C','H'] as $suit) {
            foreach (array_keys(Card::CARD_STRENGTH) as $number) {
                $card = new Card($suit, $number);
                $this->cards[] = $card;
            }
        }
    }

    public function suffleCards(): void
    {
        shuffle($this->cards);
    }

    public function chunkDeck(int $playerNum)
    {
        return array_chunk($this->cards, $playerNum);
    }
}
