<?php
if (isset($_POST['call_now'])) {
    // Read turn
    $json_file = file_get_contents("data/playerturn.json");
    $names = json_decode($json_file, true);

    // Generate HTML
    $turn_html = "";
    foreach ($names as $key => $value) {
        $format = '%s';
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
