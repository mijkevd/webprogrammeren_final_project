<?php
if (isset($_POST['submit'])) {
    // Read stones
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);
    // Get article key
    foreach($stones as $key => $value){
        if ($value['id'] == $_POST['stone_id']){
            $stone_key = $key;
        }
    }
    // Edit article
    $stones[$stone_key] = [
        'id' => $_POST['stone_id'],
        'color' => $_POST['color'],
    ];
    // Save to external file
    $json_file = fopen('/data/stones.json', 'w');
    fwrite($json_file, json_encode($stones));
    fclose($json_file);
    // Redirect to homepage
    header("Location: ../");
    die();
}
?>
