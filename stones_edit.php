<?php
if(isset($_POST['id'])){
    // Read stones
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);
    // Get stone information
    $stone_id = '';
    $stone_color = '';
    foreach($stones as $key => $value){
        if($value['id'] == $_POST['id']){
            $stone_id = $value['id'];
            $stone_color = $value['color'];
            break;
        }
    }
}
?>


<td id="<?= $stone_id ?>" class="slot <?= $stone_color ?>"></td>


