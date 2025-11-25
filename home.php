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
                    <select name="Filter" class="dropdown" name="dropdown">
                        <option value="" disabled selected>Filter</option>
                        <option value="A">Title A->Z</option>
                        <option value="Z">Title Z->A</option>
                        <option value="new">From newest</option>
                        <option value="old">From oldest</option>
                    </select>
                    <input type="submit" class="submit" name="submit">
                </form>
            </div>
            <form action=" " method="post" class="logout_form">
                <button class="logout" type="submit" name="logout">Logout</button>
            </form>
        </navbar>
        <a href="write.php">Write</a>        
    </box>
</body>
</html>