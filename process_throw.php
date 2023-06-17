<?php
if (isset($_POST['throw'])) {
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);

    $json_file = file_get_contents("data/playerturn.json");
    $turn = json_decode($json_file, true);
    $turn_number = $turn[0]['turn'];

    foreach ($stones as $key => $value) {
        if ($value['id'] == $_POST['stone-id']) {
            $stonekey = $key;
            $id = $value['id'];
        }
    }

    $increments = [35, 28, 21, 14, 7, 0];

    if($turn_number === 1) {
        foreach($increments as $increment) {
            if($stones[$stonekey + $increment]['color'] == 'white') {
                $stones[$stonekey + $increment] = [
                    'id' => $id + $increment,
                    'color' => 'yellow'
                ];
                break;
            }
        }
        $turns[0] = [
            'turn' => 2
        ];
        $json_file = fopen('data/playerturn.json', 'w');
        fwrite($json_file, json_encode($turns));
        fclose($json_file);
    } else {
        foreach($increments as $increment) {
            if($stones[$stonekey + $increment]['color'] == 'white') {
                $stones[$stonekey + $increment] = [
                    'id' => $id + $increment,
                    'color' => 'red'
                ];
                break;
            }
        }
        $turns[0] = [
            'turn' => 1
        ];
        $json_file = fopen('data/playerturn.json', 'w');
        fwrite($json_file, json_encode($turns));
        fclose($json_file);
    }

    $json_file = fopen('data/stones.json', 'w');
    fwrite($json_file, json_encode($stones));
    fclose($json_file);

    header("Location: game.php");
    die();
}


