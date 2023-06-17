<?php
/* Header */
$page_title = 'Connect four';
$navigation = Array(
    'active' => 'Game',
    'items' => Array(
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
        <div id="game-container" class="game container"></div>
        <div class="col-md-3 explanation">
            <p>
                You play the game in pairs, so 1 vs 1. <br />
                Each player has 21 discs of their color. <br />
                The one with the yellow discs always starts with the first move.<br />
                The person who is the first to connect four discs of their color wins. <br />
                This can be done horizontally, vertically and diagonally. <br />
            </p>
        </div>
    </div>
</div>


<body>
<div class="container">Player: <span class="player-turn"></span></div>


<button id="start-button" class="start-button">Reset game</button>

<div class="container">
    <form action="index.php" type="GET">
        <button id="submit" type="submit" class="btn btn-primary">Add/change name for player 1</button>
    </form>
    <form action="index2.php" type="GET">
        <button id="submit" type="submit" class="btn btn-primary">Add/change name for player 2</button>
    </form>
</div>

<div class="name-container container"></div>

<div class="container">
    <p id="games-played">Games Played: 0</p>
    <p id="wins-players"> Player 1 Wins: 0 <br />
        Player 2 Wins: 0</p>
</div>

<button id="reset-wins" class="start-button">Reset games and wins</button>
</body>
</html>



