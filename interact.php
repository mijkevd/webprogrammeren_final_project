<?php
if (isset($_POST['call_now'])) {
    $column = $_POST['column']; // Assuming the column value is sent in the AJAX request

    // Read the JSON file and decode its contents
    $json_file = file_get_contents("../data/moves.json");
    $moves = json_decode($json_file, true);

    // Update the board state in the JSON data
    $player = count($moves) % 2 === 0 ? 'Player 1' : 'Player 2'; // Determine the current player
    $moves[] = array('column' => $column, 'player' => $player); // Add the move to the array

    // Write the updated JSON data back to the file
    file_put_contents("../data/moves.json", json_encode($moves));

    // Prepare the response
    $response = array();
    $response['success'] = true;
    $response['message'] = 'Board updated successfully';

    // Send the JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
}


