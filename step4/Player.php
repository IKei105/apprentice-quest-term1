<?php

namespace TrumpWar\Step4;

class Player
{
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

    //カードを1枚引く関数
    public function drawOneCard(): Card
    {
        $headCard = array_shift($this->dealedCards);
        return $headCard;
    }

    //プレイヤー番号を返す関数
    public function getNumber(): int
    {
        return $this->number;
    }

    //プレイヤー山札のカード枚数を返す関数
    public function getDealCardsNum(): int
    {
        return count($this->dealedCards);
    }

    //プレイヤー山札から引いたカードをcurrentHandプロパティに保持する関数
    public function setCurrentHand(Card $card): void
    {
        $this->currentHand = $card;
    }

    //currentプロパティのカードを返す関数
    public function getCurrentHand(): Card
    {
        return $this->currentHand;
    }

    //勝って手に入れたカードをwinGetCardに格納する関数
    public function addWinGetCards(array $getCards): void
    {
        foreach ($getCards as $getCard) {
            $this->winGetCard[] = $getCard;
        }
    }

    //山札のカードがなくなったときに奪い取ったカードを格納する関数
    public function setWinGetCardsToDealedCards(): void
    {
        $this->dealedCards = $this->winGetCard;
        $this->winGetCard = [];
    }

    //勝って手に入れたカードをシャッフルする関数s
    public function shuffleWinGetCards(): void
    {
        shuffle($this->winGetCard);
    }

    //プレイヤーの山札を返す関数
    public function getPlayerCardsNum(): int
    {
        return count($this->dealedCards);
    }

    //勝って手に入れたカードの枚数をカウントして返す関数
    public function getPlayerWinGetCardsNum(): int
    {
        return count($this->winGetCard);
    }

    //プレイヤーの名前を返す関数
    public function getName(): string
    {
        return $this->name;
    }
}