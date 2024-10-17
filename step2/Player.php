<?php

namespace TrumpWar\Step2;

class Player
{
    public const HEAD = 0;
    private $dealedCards = [];
    private $winGetCard = [];
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

    //配布されたカードを入れるプロパティ
    public function getDealCardsNum()
    {
        return count($this->dealedCards);
    }

    public function setCurrentHand(Card $card)
    {
        $this->currentHand = $card;
    }

    public function getCurrentHand(): Card
    {
        return $this->currentHand;
    }

    //これを奪い取ったカードを入れる関数
    public function addWinGetCards(array $getCards): void
    {
        foreach ($getCards as $getCard) {
            $this->winGetCard[] = $getCard;
        }
    }

    //山札のカードがなくなったときに奪い取ったカードを格納する関数
    public function setWinGetCardsToDealedCards()
    {
        $this->dealedCards = $this->winGetCard;
        $this->winGetCard = [];
    }

    public function shuffleWinGetCards()
    {
        shuffle($this->winGetCard);
    }

    //プレイヤーの山札を返す関数
    public function getPlayerCardsNum()
    {
        return count($this->dealedCards);
    }

    public function getPlayerWinGetCardsNum(): int
    {
        return count($this->winGetCard);
    }
}
