<?php

namespace TrumpWar\Step3;

class Deck
{
    //カードインスタンスを格納する配列、52枚入り(ジョーカーはなし)
    private $cards = [];
    private const TOTAL_CARDS = 52;

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

    public function chunkDeck(array $players): array
    {
        $playersCount = count($players);
        $needChunk = (int)(self::TOTAL_CARDS / count($players));
        $chunkArray = [];
        for ($i = 1; $i <= $playersCount; $i++) {
            if ($i === $playersCount) {
                $chunkArray[$i] = $this->cards;
            } else {
                $chunkArray[$i] = array_splice($this->cards, 0, $needChunk);
            }
        }
        return $chunkArray;
    }

    public function getCards(): array
    {
        return $this->cards;
    }
}
