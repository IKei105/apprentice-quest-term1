<?php

namespace TrumpWar\Step2;

require_once('Card.php');
require_once('Deck.php');
require_once('Game.php');
require_once('Judge.php');
require_once('message.php');
require_once('Player.php');


//ゲームスタートする
$game = new Game();
Message::startWar();

//デッキの生成
$deck = new Deck();

//シャッフルデッキの生成
$deck->suffleCards();

//プレイヤーインスタンスの生成
$players = Game::createPlayer();

//カードの配布、プレイヤーインスタンスに配布されたカードの格納
$game->dealCards($players, $deck);

//勝負
$losePlayerNumber = $game->battle($players);

//結果の表示
Message::result($losePlayerNumber, $players);
