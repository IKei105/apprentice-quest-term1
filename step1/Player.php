<?php

namespace TrumpWar\Step1;

class Player
{
    private $dealedCards = [];
    private $currentHand;

    public function __construct(private int $number)
    {
    }

    public function setDealedCard(array $dealedCards)
    {
        //配布されたカードをdealedカードに格納する処理
        $this->dealedCards = $dealedCards;
    }

    public function drawOneCard(): Card
    {
        $headCard = array_shift($this->dealedCards);
        return $headCard;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getDealCardsNum()
    {
        return count($this->dealedCards);
    }

    public function setCurrentHand(Card $card)
    {
        $this->currentHand = $card;
    }

    public function getCurrentHand()
    {
        return $this->currentHand;
    }
}
