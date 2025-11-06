<?php
    include 'db.php';
    
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

            </div>
            <div class="elements">
                <div class="select">
                    <form method="post" action="" class="options">
                        <button class="pauses" type="submit" name="pauses">PAUSES</button>
                        <button class="symbols" type="submit" name="symbols">SYMBOLS</button>
                    </form>
                </div>
                <div class="search">
                    <form action="" method="post" class="filter">
                        <input type="text" class="base_note" placeholder="Search base by note" name="base">
                        <button class="enter" type="submit" name="enter">SEARCH</button>
                    </form>
                </div>
                <div class="data">
                    <?php
                        $name = 'chord';
                        if(isset($_POST['pauses'])){
                            echo "pauses";
                        }elseif(isset($_POST['symbols'])){
                            echo "<p>" . $data[0]['chord'] . "</p>";
                        }

                    ?>
                </div>
            </div>
        </main>
    </box>
</body>
</html>