<?php

    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }

    $json = file_get_contents('chords.json');
    $data = json_decode($json, true);
    
    $json2 = file_get_contents('chords_base.json');
    $data2 = json_decode($json2, true);

    if(isset($_POST['button'])){
        if($_POST['button'] == 1){
            
        }elseif ($_POST['button'] == 2){
            
        }
    }



    require('sheet.class.php');
    if(isset($_POST['chord'])){

        $sheet = new makeSheet($_POST['chord'], $_SESSION['username']);

        $sheet->makeJSON();

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/write.css">
    <!-- Title font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">

    <!-- text font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <title>Write</title>
</head>
<body>
    <box class="box">
        <navbar class="nav">
            <a href="home.php" class="home"><img class="home_img" src="img/binder.png" alt="binder - home"></a>
            <form method="post" action="" class="buttons">
                <button class="back" type="submit" name="button" value="1">BACK</button>
                <button class="save" type="submit" name="button" value="2">SAVE</button>
            </form>
        </navbar>
        <main class="main">
            <div class="notes">
                <div class="main_notes">
                    <?php
                    
                        if(isset($_POST['chord'])){
                            echo $_POST['chord'];
                        }
                    
                    ?>
                </div>
            </div>
            <div class="elements">
                <div class="select">
                    <form method="post" action="" class="options">
                        <button class="pauses" type="submit" name="choice" value="1">PAUSES</button>
                        <button class="symbols" type="submit" name="choice" value="2">CHORDS</button>
                    </form>
                </div>
                <div class="search">
                    <form action="" method="post" class="filter">
                        <input type="text" class="base_note" placeholder="Search chord by base" name="base">
                        <button class="enter" type="submit" name="enter">SEARCH</button>
                    </form>
                </div>
                <div class="data">
                    <form method="post" action="" class="chords">
                        <?php
                            if(!isset($_POST['choice'])){
                                foreach ($data as $chord){
                                    echo "<button type='submit' name='chord' class='chord' value='" . $chord['chord'] . "'>" . $chord['chord'] . "</button>";
                                }
                            }elseif($_POST['choice'] == 1){
                                echo "pauses";
                            }elseif($_POST['choice'] == 2){
                                foreach ($data as $chord){
                                    echo "<button type='submit' name='chord' class='chord' value='" . $chord['chord'] . "'>" . $chord['chord'] . "</button>";
                                }
                            }elseif(isset($_POST['enter'])){
                                if($_POST['base'] === ""){
                                    echo "<div class='error'>No base note were entered!</div>";
                                }elseif(isset($_POST['base'])){
                                    $base = $_POST['base'];
                                    foreach ($data2[$base] as $chord){
                                        echo "<button type='submit' name='chord' class='chord' value='" . $chord . "'>" . $chord . "</button>";
                                    } 
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </main>
    </box>
</body>
</html>