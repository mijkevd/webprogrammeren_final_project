<?php

if (isset($_POST['call_now'])) {
    $json_file = file_get_contents("data/wins_count.json");
    $wins = json_decode($json_file, true);

    $wins[0] = [
        'wins' => 0
    ];

    $wins[1] = [
        'wins' => 0
    ];

    $json_file = fopen('data/wins_count.json', 'w');
    fwrite($json_file, json_encode($wins));
    fclose($json_file);

    $json_file = file_get_contents("data/wins_count.json");
    $wins = json_decode($json_file, true);

    $wins_player1 = $wins[0]['wins'];
    $wins_player2 = $wins[1]['wins'];

    $format = '<p class="wins-players">Player 1 Wins: %s <br /> Player 2 Wins: %s </p>';
    $wins_html = sprintf($format, $wins_player1, $wins_player2);

    // Save html into array
    $export_data = [
        'html' => $wins_html
    ];

    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);

}