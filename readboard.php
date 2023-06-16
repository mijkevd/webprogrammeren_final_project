<?php
if (isset($_POST['call_now'])) {
    // Read articles
    $json_file = file_get_contents("data/stones.json");
    $stones = json_decode($json_file, true);
    $json_turn = file_get_contents("data/stones.json");
    $player = json_decode($json_file, true);
    $currentplayer = $player['turn'];


    // Generate HTML
    $board_html = '<table>';
    $color = '';
    $i = 0;
    $tr_list = [0, 7, 14, 21, 28, 35];
    $tr_close_list = [6, 13, 20, 27, 34, 41];
    foreach ($stones as $stone) {
        if (in_array($i, $tr_list)) {
            $board_html .= '<tr>';
        }
        $id = $stone['id'];
        $board_html .=  '<td id="' . $id . '" class="slot">';
        $board_html .= '<button id="' . $id . '" type="submit" class="stone-button">Throw</button>';
        $board_html .= '</td>';
        if (in_array($i, $tr_close_list)) {
            $board_html .= '</tr>';
        }
        $i = $i + 1;
    }
    if ($color === 'red') {
        $color = 'yellow';
    }
    else if ($color === 'yellow') {
        $color = 'red';
    }
    $board_html .= '</table>';

    $currentplayer = $currentplayer == 1 ? 2 : 1;

    // Save html into array
    $export_data = [
        'html' => $board_html,
        'currentplayer' => $currentplayer
    ];
    $json_file = file_get_contents("data/names.json");
    $names = json_decode($json_file, true);
    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);
}

if (isset($_POST['newTurn'])) {
    $json_file = file_get_contents('playerturn.json');
    $data = json_decode($json_file, true);

    $data[0]['turn'] = $_POST['newTurn'];

    file_put_contents('playerturn.json', json_encode($data));
}
?>
