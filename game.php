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

<script src="js/main.js" charset="utf-8"></script>

<div class="pd-40"></div>
    <div class="row">
        <div class="game container">
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
                echo '<td id="<?php echo $id; ?>" class="slot">';
                //echo '<td id="$stone['id']"></td>';
                if(in_array($i, $tr_close_list)) {
                    echo '</tr>';
                }
                $i = $i + 1;
            }
            echo '</table>';
            ?>
        </div>
    </div>
</div>



<div class="player-turn"></div>
<div id="result"></div>
<button id="start-button">Start Game</button>
<button id="stop-button" type="button">Stop Game</button>

<p id="inputname">Player < Wins: 0</p>
<p id="inputgame">Player Two Wins: 0</p>

<?php
include __DIR__ . '/tpl/body_end.php';
?>

