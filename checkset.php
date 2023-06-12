<?php
if (isset($_POST['call_now'])) {
    $json_file = file_get_contents("../data/articles.json");
    $set = json_decode($json_file, true);
}
