<?php
    include 'db.php';
    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }

    $chord = "C";
    $json = file_get_contents('https://api.uberchord.com/v1/chords/Bb');
    $data = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write</title>
</head>
<body>
    <box class="box">
        <navbar class="nav">
            <a href="home.php" class="home"><img src="img/binder.png" alt="binder - home"></a>
            
        </navbar>
        <search class="chords">
            <?php
                echo $data;
            ?>
        </search>
    </box>
</body>
</html>