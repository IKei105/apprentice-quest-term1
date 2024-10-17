<?php

namespace TrumpWar\Step3;

class Player
{
    public const HEAD = 0;
    private $dealedCards = [];
    private $winGetCard = [];
    private $currentHand;

    public function __construct(private int $number, private $name)
    {
    }

    //配布されたカードをdealedカードに格納する処理
    public function setDealedCard(array $dealedCards): void
    {
        $this->dealedCards = $dealedCards;
    }


    public function drawOneCard(): Card
    {
        $headCard = array_shift($this->dealedCards);
        return $headCard;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    //配布されたカードを入れるプロパティ
    public function getDealCardsNum(): int
    {
        return count($this->dealedCards);
    }

    public function setCurrentHand(Card $card): void
    {
        $this->currentHand = $card;
    }

    public function getCurrentHand(): Card
    {
        return $this->currentHand;
    }

    //これを奪い取ったカードを入れるメソッド
    public function addWinGetCards(array $getCards): void
    {
        foreach ($getCards as $getCard) {
            $this->winGetCard[] = $getCard;
        }
    }

    //山札のカードがなくなったときに奪い取ったカードを格納するメソッド
    public function setWinGetCardsToDealedCards(): void
    {
        $this->dealedCards = $this->winGetCard;
        $this->winGetCard = [];
    }

    //カードをシャッフルするメソッド
    public function shuffleWinGetCards(): void
    {
        shuffle($this->winGetCard);
    }

    //プレイヤーの山札を返すメソッド
    public function getPlayerCardsNum(): int
    {
        return count($this->dealedCards);
    }

    //勝って手に入れたカードを返すメソッド
    public function getPlayerWinGetCardsNum(): int
    {
        return count($this->winGetCard);
    }

    //名前を返す
    public function getName(): string
    {
        return $this->name;
    }
}
