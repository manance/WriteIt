<?php
    include 'db.php';
    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('location: index.php');
        exit();
    }
    if(isset($_SESSION['sheet_name'])){
        unset($_SESSION['sheet_name']);
    }

    $data = json_decode(file_get_contents('music.json'), true);

    function dateSort($date1, $date2){
        $time1 = strtotime($date1['date']);
        $time2 = strtotime($date2['date']);
        return $time2 - $time1;
    }
    function rdateSort($date1, $date2){
        $time1 = strtotime($date1['date']);
        $time2 = strtotime($date2['date']);
        return $time1 - $time2;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/home.css">

    <!-- Title font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">

    <!-- text font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <box class="box">
        <navbar class="nav">
            <a href="profile.php" class="profile"><img class="prof_img" src="img/user.png" alt=""></a>
            <div class="search_bar">
                <form class="form" action="" method="post">
                    <input class="search" type="text" placeholder="Search your songs..." name="search">
                    <select name="filter" class="dropdown">
                        <option value="1">Title A->Z</option>
                        <option value="2">Title Z->A</option>
                        <option value="3">From newest</option>
                        <option value="4" selected>From oldest</option>
                    </select>
                    <input type="submit" class="submit" name="submit">
                </form>
            </div>
            <form action=" " method="post" class="logout_form">
                <button class="logout" type="submit" name="logout">Logout</button>
            </form>
        </navbar>         
        <main class="main">
            <?php
            if(isset($_POST['submit'])){
                if($_POST['search'] != ""){
                    $search = $_POST['search'];
                    if($data != null){
                        if($_POST['filter'] == 1){
                            sort($data);
                        }elseif($_POST['filter'] == 2){
                            rsort($data);
                        }elseif($_POST['filter'] == 3){
                            usort($data, 'sortDate');
                        }elseif($_POST['filter'] == 3){
                            usort($data, 'rsortDate');
                        }
                        foreach($data as $sheet){
                            $sheet_name = str_replace(" ", "_", $sheet['name']);
                            similar_text($sheet['name'],$_POST['search'],$percent);
                            if($sheet['author'] == $_SESSION['username'] && $percent > 50){
                                echo "
                                <form class='song_card' method='post' action='sheet.php'>
                                    <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                                </form>";
                            }
                        }
                    }
                }
                if($_POST['filter'] == 1 && $_POST['search'] == ""){
                    if($data != null){
                        sort($data);
                        foreach($data as $sheet){
                            $sheet_name = str_replace(" ", "_", $sheet['name']); 
                            if($sheet['author'] == $_SESSION['username']){
                                echo "
                                <form class='song_card' method='post' action='sheet.php'>
                                    <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                                </form>";
                            }
                        }
                    }
                }elseif($_POST['filter'] == 2 && $_POST['search'] == ""){
                    if($data != null){
                        rsort($data);
                        foreach($data as $sheet){
                            $sheet_name = str_replace(" ", "_", $sheet['name']); 
                            if($sheet['author'] == $_SESSION['username']){
                                echo "
                                <form class='song_card' method='post' action='sheet.php'>
                                    <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                                </form>";
                            }
                        }
                    }
                }elseif($_POST['filter'] == 3 && $_POST['search'] == ""){
                    if($data != null){
                        usort($data, 'dateSort');
                        foreach($data as $sheet){
                            $sheet_name = str_replace(" ", "_", $sheet['name']); 
                            if($sheet['author'] == $_SESSION['username']){
                                echo "
                                <form class='song_card' method='post' action='sheet.php'>
                                    <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                                </form>";
                            }
                        }
                    }
                }elseif($_POST['filter'] == 4 && $_POST['search'] == ""){
                    if($data != null){
                        usort($data, 'rdateSort');
                        foreach($data as $sheet){
                            $sheet_name = str_replace(" ", "_", $sheet['name']); 
                            if($sheet['author'] == $_SESSION['username']){
                                echo "
                                <form class='song_card' method='post' action='sheet.php'>
                                    <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                                </form>";
                            }
                        }
                    }
                }
            }else{
                if($data != null){
                    foreach($data as $sheet){
                        $sheet_name = str_replace(" ", "_", $sheet['name']); 
                        if($sheet['author'] == $_SESSION['username']){
                            echo "
                            <form class='song_card' method='post' action='sheet.php'>
                                <button type='submit' class='song_button' name='song_button' value=" . $sheet_name . ">" . $sheet['name'] . "</button>
                            </form>";
                        }
                    }
                }
            }

            ?>
        </main>  
        <a class="write_button" href="write.php">Write</a>    
    </box>
</body>
</html>