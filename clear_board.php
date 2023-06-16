<?php

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

debug_to_console("Hello");

if (isset($_POST['call_now'])) {
    // Read articles
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);

    foreach($stones as $key => $value) {
        $id = $value['id'];
        $stones[$key] = [
            'id' => $id,
            'color' => 'white'
        ];
    }

    $json_file = fopen('data/stones.json', 'w');
    fwrite($json_file, json_encode($stones));
    fclose($json_file);

}
?>
