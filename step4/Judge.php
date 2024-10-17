<?php

namespace TrumpWar\Step4;

class Judge
{
    public const SPADE = 'S';
    public const SPADE_A_STRENGTHS = 13;
    public function __construct()
    {
    }

    //一番大きい数を出したプレイヤーの番号を配列に入れて返す関数
    public static function judge($playersHand): array
    {
        $cardStrengths = [];
        $cardStrengthTemp = 0;
        $resultArray = [];

        foreach ($playersHand as $playerNumber => $playerHand) {
            $playerHandStrengths = $playerHand->getStrong();
            $playerHandSuit = $playerHand->getSuit();

            if ($playerHandStrengths === Card::JOKER_STRENGTH) {
                $resultArray[] = $playerNumber;
                return $resultArray;
            } elseif ($playerHandSuit === self::SPADE and $playerHandStrengths === self::SPADE_A_STRENGTHS) {
                $resultArray[] = $playerNumber;
                return $resultArray;
            } else {
                $cardStrengths[$playerNumber] = $playerHandStrengths;
            }
        }

        arsort($cardStrengths);

        foreach ($cardStrengths as $playerNumber => $cardStrength) {
            if (empty($cardStrengthTemp)) {
                $cardStrengthTemp = $cardStrength;
                $resultArray[] = $playerNumber;
            } elseif ($cardStrengthTemp === $cardStrength) {
                $resultArray[] = $playerNumber;
            }
        }

        return $resultArray;
    }
}
