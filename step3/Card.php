<?php

namespace TrumpWar\Step3;

class Card
{
    public const CARD_STRENGTH = [
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13
    ];

    public const SUIT_NAME = [
        'H' => 'ハート',
        'C' => 'クローバー',
        'D' => 'ダイヤ',
        'S' => 'スペード',
    ];

    public function __construct(private string $suit, private string $number)
    {
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getStrong(): int
    {
        return self::CARD_STRENGTH[$this->number];
    }
}
