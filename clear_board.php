<?php

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

    $json_file = file_get_contents("data/playerturn.json");
    $turns = json_decode($json_file, true);


    $turns[0] = [
        'turn' => 1
    ];

    $json_file = fopen('data/playerturn.json', 'w');
    fwrite($json_file, json_encode($turns));
    fclose($json_file);

    $json_file = file_get_contents("data/number_of_games.json");
    $games = json_decode($json_file, true);

    $current_games = $games[0]['games'];
    $new_games = $current_games + 1;

    $games[0] = [
        'games' => $new_games
    ];

    $json_file = fopen('data/number_of_games.json', 'w');
    fwrite($json_file, json_encode($games));
    fclose($json_file);

    $json_file = file_get_contents("data/number_of_games.json");
    $games = json_decode($json_file, true);

    $number_of_games = $games[0]['games'];

    $format = 'Games Played: %s';
    $games_html = sprintf($format, $number_of_games);

    // Save html into array
    $export_data = [
        'html' => $games_html
    ];

    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);

}
?>
