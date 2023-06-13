<?php
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "ajax";

$conn = new mysqli($servername, $username, $password, $dbname);


session_start();

// Game state
$games = array();

// Make a move
function makeMove($col)
{
    global $games;
    $gameId = $_SESSION['gameId'];
    if (array_key_exists($gameId, $games)) {
        $game = $games[$gameId];
        $currentPlayer = $game["players"][$game["turn"]];
        if ($_SESSION['playerId'] !== $currentPlayer) {
            return "It's not your turn";
        }
        $row = getLowestEmptyRow($game["board"], $col);
        if ($row === -1) {
            return "Column is full";
        }
        $game["board"][$row][$col] = $game["turn"];
        $games[$gameId] = $game;
        if (checkWin($game["board"], $row, $col)) {
            return "win";
        } elseif (checkDraw($game["board"])) {
            return "draw";
        } else {
            $game["turn"] = ($game["turn"] + 1) % 2;
            $games[$gameId] = $game;
            return "success";
        }
    }
    return "Game not found";
}

// Create an empty game board
function createEmptyBoard()
{
    $board = array();
    for ($row = 0; $row < 6; $row++) {
        $board[$row] = array_fill(0, 7, null);
    }
    return $board;
}

// Get the lowest empty row in a column
function getLowestEmptyRow($board, $col)
{
    for ($row = 5; $row >= 0; $row--) {
        if ($board[$row][$col] === null) {
            return $row;
        }
    }
    return -1; // Column is full
}

// Check if a player has won
function checkWin($board, $row, $col)
{
    $directions = array(
        array(1, 0), // Horizontal
        array(0, 1), // Vertical
        array(1, 1), // Diagonal \
        array(1, -1) // Diagonal /
    );

    $player = $board[$row][$col];

    foreach ($directions as $dir) {
        $count = 1;
        $count += countInDirection($board, $row, $col, $dir[0], $dir[1]);
        $count += countInDirection($board, $row, $col, -$dir[0], -$dir[1]);
        if ($count >= 4) {
            return true;
        }
    }

    return false;
}

// Count consecutive discs in a given direction
function countInDirection($board, $row, $col, $rowDir, $colDir)
{
    $player = $board[$row][$col];
    $count = 0;
    $r = $row + $rowDir;
    $c = $col + $colDir;

    while ($r >= 0 && $r < 6 && $c >= 0 && $c < 7 && $board[$r][$c] === $player) {
        $count++;
        $r += $rowDir;
        $c += $colDir;
    }

    return $count;
}

// Check if the game is a draw
function checkDraw($board)
{
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if ($cell === null) {
                return false;
            }
        }
    }
    return true;
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'createGame') {
        $gameId = createGame();
        echo json_encode(array("gameId" => $gameId));
    } elseif ($_POST['action'] === 'joinGame') {
        $gameId = $_POST['gameId'];
        $success = joinGame($gameId);
        echo json_encode(array("success" => $success));
    } elseif ($_POST['action'] === 'makeMove') {
        $col = $_POST['col'];
        $result = makeMove($col);
        echo json_encode(array("result" => $result));
    }
}

