<?php
if(isset($_POST['id'])){
    // Read stones
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);
    $player1 = 'yellow';
    $player2 = 'red';
    $playerturn = 1;
    // Get stone information
    $stone_id = '';
    $stone_color = '';
    foreach($stones as $key => $value){
        if($value['id'] == $_POST['id'] && $playerturn == 1){
            $stone_id = $value['id'];
            $stone_color = 'yellow';
            $playerturn = 2;
            break;
        } else if ($value['id'] == $_POST['id'] && $playerturn == 2){
            $stone_id = $value['id'];
            $stone_color = 'red';
            $playerturn = 1;
            break;
        }
    }
}
?>


<td id="<?= $stone_id ?>" class="slot <?= $stone_color ?>"></td>


