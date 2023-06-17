<?php
if (isset($_POST['newColor']) && isset($_POST['stoneId'])) {
    // Read articles
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);

    // Update variables
    foreach ($stones as $key => $value) {
        if ($value['id'] == $_POST['stoneId']) {
            $stones[$key]['color'] = $_POST['newColor'];
        }
    }

    $newJsonString = json_encode($stones);
    file_put_contents('data/stones.json', $newJsonString);
}
?>



