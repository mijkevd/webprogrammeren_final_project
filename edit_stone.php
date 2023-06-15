<?php
if (isset($_POST['submit'])) {
    // Read stones
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);
    $json_names = file_get_contents("data/stones.json");
    $names = json_decode($json_file, true);
    $playerturn = 1;
    // Get article key
    foreach ($stones as $key => $value) {
        if ($value['id'] == $_POST['stone_id']) {
            $stone_key = $key;
            // Edit article

            if ($playerturn === 1) {
                $stones[$stone_key] = [
                    'id' => $_POST['stone_id'],
                    'color' => 'yellow',
                ];
                $playerturn = 2;
            }
            if ($playerturn === 2) {
                $stones[$stone_key] = [
                    'id' => $_POST['stone_id'],
                    'color' => 'red',
                ];
                $playerturn = 1;
            }
        }
    }
    // Save to external file
    $json_file = fopen('/data/stones.json', 'w');
    fwrite($json_file, json_encode($stones));
    fclose($json_file);
    // Redirect to homepage
    header("Location: ../");
    die();
}
?>
