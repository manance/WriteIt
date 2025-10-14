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
    <title>Document</title>
</head>
<body>
    <div class="p">hello</div>
    <form action=" " method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <a href="profile.php">Profile</a>
    <a href="write.php">Write</a>
</body>
</html>