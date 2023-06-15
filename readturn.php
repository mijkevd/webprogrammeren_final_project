<?php
if (isset($_POST['call_now'])) {
    // Read articles
    $json_file = file_get_contents("data/playerturn.json");
    $names = json_decode($json_file, true);

    // Generate HTML
    $turn_html = "";
    foreach ($names as $key => $value) {
        $format = '<p>Player: <span class="name-player-1">%s</span></p>';
        $turn_html .= sprintf($format, $value['turn']);
    }
    // Save html into array
    $export_data = [
        'html' => $turn_html
    ];
    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);
}
?>
