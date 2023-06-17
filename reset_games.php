<?php
if (isset($_POST['call_now'])) {
    $json_file = file_get_contents("data/number_of_games.json");
    $games = json_decode($json_file, true);

    $games[0] = [
        'games' => 0
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