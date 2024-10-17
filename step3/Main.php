<?php

namespace TrumpWar\Step3;

require_once('Card.php');
require_once('Deck.php');
require_once('Game.php');
require_once('Judge.php');
require_once('message.php');
require_once('Player.php');

Message::startWar();
echo 'プレイヤーの人数を入力してください（2〜5）: ';
$playerNum = (int)trim(fgets(STDIN));
while (!(2 <= $playerNum and $playerNum <= 5)) {
    echo '2〜5で入力してください。';
    $playerNum = (int)trim(fgets(STDIN));
}

//ゲームスタートする
$game = new Game($playerNum);

//デッキの生成
$deck = new Deck();

//シャッフルデッキの生成
$deck->suffleCards();

//プレイヤーインスタンスの生成
$players = $game->createPlayer();

//カードの配布、プレイヤーインスタンスに配布されたカードの格納
$game->dealCards($players, $deck);

//勝負
$losePlayerNumber = $game->battle($players);

//結果の表示
Message::result($losePlayerNumber, $players);
