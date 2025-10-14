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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/main.css">

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

        </navbar>
        <form action=" " method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        <a href="profile.php">Profile</a>
        <a href="write.php">Write</a>        
    </box>
</body>
</html>