<?php
/* Header */
$page_title = 'Connect four';
$navigation = Array(
    'active' => 'Home screen',
'items' => Array(
'Game' => '../webprogrammeren_final_project/game.php',
)
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>

<?php
if (isset($_POST['submit1'])) {
    $json_file = file_get_contents("data/names.json");
    $names = json_decode($json_file, true);

    foreach($names as $key => $value){
        if ($value['id'] === 1){
            $namekey = $key;
        }
    }

    $input_name = $_POST['name1'];

    if(is_string($input_name) && strlen($input_name)<11) {
        $names[$namekey] = [
            'id' => 1,
            'name' => $_POST['name1'],
        ];
        $json_file = fopen('data/names.json', 'w');
        fwrite($json_file, json_encode($names));
        fclose($json_file);

        // Redirect to game page
        header("Location: ./game.php");
        die();
    }
}
?>

 <div class="container">
        <div class="row">
            <div class="col-md-6 enter-name">
                <form id='user-form' class="form-1" action="index.php" method="POST">
                    <div class="form-group">
                        <label for="inputname">Player 1, enter your name</label>
                        <input type="text" class="form-control" id="name1" name="name1">
                        <?php
                        if (strlen($input_name)>=11) {
                        echo "Name cannot be longer than 10 characters";
                        }
                        ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please enter a name.
                    </div>
                    <button id="submit" name="submit1" type="submit" class="btn btn-primary">Add player</button>
                    <script src="js/main.js" charset="utf-8"></script>
                </form>
            </div>

        </div>
    </div>


<?php
include __DIR__ . '/tpl/body_end.php';
?>
