<?php

    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        session_destroy();
        exit();
    }

    if(isset($_POST['name_enter'])){
        if($_POST['name'] == ""){
            
        }else{
            $_SESSION['sheet_name'] = $_POST['name'];
        }
    }

    $json = file_get_contents('chords.json');
    $data = json_decode($json, true);
    
    $json2 = file_get_contents('chords_base.json');
    $data2 = json_decode($json2, true);

    $json3 = file_get_contents('music.json');
    $data3 = json_decode($json3, true);

    if(isset($_POST['button'])){
        if($_POST['button'] == 1){
            
        }elseif ($_POST['button'] == 2){
            
        }
    }

    require('sheet.class.php');
    if(isset($_POST['chord'])){

        $sheet = new makeSheet($_POST['chord'], $_SESSION['username'], $_SESSION['sheet_name']);
        if(isset($data3)){
            foreach($data3 as $x){
                if($x['name'] != $_SESSION['sheet_name']){
                    $sheet->makeJSON();
                }else{
                    $sheet->updateJSON();
                }
            }
        }else{
            $sheet->makeJSON();
        }

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
            
            //Doestroying song name session needs to be done
            
            <form action="" method="post" class="name">
                <input type="text" class="name" name="name" placeholder="Enter sheet name">
                <input type="submit" class="name_enter" name="name_enter" value="ENTER">
            </form>
            <form method="post" action="" class="buttons">
                <button class="back" type="submit" name="button" value="1">BACK</button>
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
                            if(isset($_POST['enter'])){
                                if($_POST['base'] === ""){
                                    echo "<div class='error'>No base note were entered!</div>";
                                }else{
                                    $base = $_POST['base'];
                                    if(isset($data2[$base])){
                                        foreach ($data2[$base] as $chord){
                                            echo "<button type='submit' name='chord' class='chord' value='" . $chord . "'>" . $chord . "</button>";
                                        } 
                                    }else{
                                        echo "<div class='error'>No chords found for the entered base note!</div>";
                                    }
                                    
                                }
                            }elseif(isset($_POST['choice']) && $_POST['choice'] == 1){
                                echo "pauses";
                                
                            }else{
                                foreach ($data as $chord){
                                    echo "<button type='submit' name='chord' class='chord' value='" . $chord['chord'] . "'>" . $chord['chord'] . "</button>";
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