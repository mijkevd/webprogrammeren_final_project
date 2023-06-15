<?php
/* Header */
$page_title = 'Connect four';
$navigation = Array(
    'active' => 'Home screen',
'items' => Array(
'Home screen' => '../webprogrammeren_final_project/index.php',
'Game' => '../webprogrammeren_final_project/game.php',
)
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>


<header class="intro">Connect Four</header>

    <div class="container">
        <div class="row">
            <div class="col-md-6 enter-name">
                <form id='user-form' method="GET">
                    <div class="form-group">
                        <label for="inputname">Enter your name</label>
                        <input type="text" class="form-control" id="inputname" name="name">
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Start Game</button>
                    <script src="main.js" charset="utf-8"></script>
                </form>
            </div>
            <div class="col-md-6 explanation">
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

    <?php
    include __DIR__ . '/tpl/body_end.php';
    ?>
