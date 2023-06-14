<?php
/* Header */
$page_title = 'Connect four';
$navigation = Array(
    'active' => 'Game',
    'items' => Array(
        'Home screen' => '../webprogrammeren_final_project/index.php',
        'Game' => '../webprogrammeren_final_project/game.php',
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Connect Four</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/main.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<div class="player-turn"></div>

<div class="container">

<div class="game">
    <table>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
        <tr>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
            <td class="slot"></td>
        </tr>
    </table>
</div>
</div>
<div id="result"></div>
<button id="start-button">Start Game</button>
<button id="stop-button" type="button">Stop Game</button>
<p id="games-played">Games Played: 0</p>
<p id="inputname">Player One Wins: 0</p>
<p id="inputgame">Player Two Wins: 0</p>
</body>
</html>
