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
    <link rel="stylesheet" href="css/index.css">
    <script src="js/main.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<header class="intro">Connect Four</header>

<form action="index.php" type="GET">
    <button id="submit" type="submit" class="btn btn-primary">Add player 1</button>
</form>
<form action="index2.php" type="GET">
    <button id="submit" type="submit" class="btn btn-primary">Add player 2</button>
</form>

<?php
$json_file = file_get_contents("data/names.json");
$names = json_decode($json_file, true);

foreach($names as $key => $value){
    if ($value['id'] == 1){
        $name_player1 = $value['name'];
    }
    else if ($value['id'] == 2){
        $name_player2 = $value['name'];
    }
}
?>

<div class="pd-40"></div>
    <div class="row">
        <div id="game-container" class="game container">
            <?php
            $stones = json_decode(file_get_contents('data/stones.json'), true);
            echo '<table>';
            $i = 0;
            $tr_list = [0, 7, 14, 21, 28, 35];
            $tr_close_list = [6, 13, 20, 27, 34, 41];
            foreach ($stones as $stone) {
                if(in_array($i, $tr_list)) {
                    echo '<tr>';
                }
                $id = $stone['id'];
                echo '<td id="'. $id. '" class="slot">';
                echo '<button id="'. $id. '" type="submit" class="btn btn-primary">Throw stone</button>';
                echo '</td>';
                //echo '<td id="$stone['id']"></td>';
                if(in_array($i, $tr_close_list)) {
                    echo '</tr>';
                }
                $i = $i + 1;
            }
            echo '</table>';
            ?>
        </div>
        <div class="col-md-3 explanation">
            <p>
                You play the game in pairs, so 1 against 1. <br />
                Each has 21 yellow or red stones, the one with the yellow stones always starts with the first move,
                after that it is always a turn. <br />
                A move may not be made twice in a row. <br />
                The person who is the first to get four stones of their color in a row wins. <br />
                This is allowed horizontally, vertically and diagonally. <br />
                5 in a row or more, does not count.
            </p>
        </div>
    </div>
</div>


<body>
<div class="player-turn"></div>
<div id="result"></div>

<button id="start-button">Start Game</button>
<button id="stop-button" type="button">Stop Game</button>

<div class="name-container container"></div>

<div class="container">
    <p id="games-played">Games Played: 0</p>
    <p id="inputname">Player < Wins: 0</p>
    <p id="inputgame">Player Two Wins: 0</p>
</div>
</body>
</html>

