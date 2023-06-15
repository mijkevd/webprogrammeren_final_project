<?php
if (isset($_POST['newTurn'])) {
$json_file = file_get_contents('playerturn.json');
$data = json_decode($json_file, true);

$data[0]['turn'] = $_POST['newTurn'];

file_put_contents('playerturn.json', json_encode($data));
}
?>
