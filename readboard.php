<?php
if (isset($_POST['call_now'])) {
    // Read board
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);

    // Generate HTML
    $board_html = '<table>';
    $i = 0;
    $tr_list = [0, 7, 14, 21, 28, 35];
    $tr_close_list = [6, 13, 20, 27, 34, 41];
    foreach ($stones as $stone) {
        if (in_array($i, $tr_list)) {
            $board_html .= '<tr>';
        }
        $id = $stone['id'];
        $color = $stone['color'];
        $board_html .= '<td id="' . $id . '" class="slot ' . $color . '">';
        $board_html .= '<form id="' . $id . '" class="throw-stone" action="process_throw.php" method="POST">';
        $board_html .= '<input type="text" name="stone-id" value="' . $id . '" hidden/>';
        $board_html .= '<button id="' . $id . '" name="throw" type="submit" class="btn btn-primary throw" >Throw</button>';
        $board_html .= '</form>';
        $board_html .= '</td>';
        if (in_array($i, $tr_close_list)) {
            $board_html .= '</tr>';
        }
        $i = $i + 1;
    }
    $board_html .= '</table>';


    // Save html into array
    $export_data = [
        'html' => $board_html,
    ];
    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);
}
?>


