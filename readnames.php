<?php
if (isset($_POST['call_now'])) {
    // Read articles
    $json_file = file_get_contents("data/names.json");
    $names = json_decode($json_file, true);

    // Generate HTML
    $names_html = "";
    foreach ($names as $key => $value) {
        $format = '<p>Player <span class="player-id">%s</span>: <span class="name-player-1">%s</span></p>';
        $names_html .= sprintf($format, $value['id'], $value['name']);
    }
    // Save html into array
    $export_data = [
        'html' => $names_html
    ];
    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);
}

if (isset($_POST['newTurn'])) {
    $json_file = file_get_contents('playerturn.json');
    $data = json_decode($json_file, true);

    $data[0]['turn'] = $_POST['newTurn'];

    file_put_contents('turn.json', json_encode($data));
}
?>