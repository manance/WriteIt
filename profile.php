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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WriteIt - <?php echo $_SESSION['username']?></title>
    <link rel="stylesheet" href="css/profile.css">
    <!-- Title font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">

    <!-- text font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <a href="home.php" class="back">BACK</a>
    <div class="box">
        <div class="name"><?php echo $_SESSION['username'];?></div>
        <div class="buttons">
            <form action=" " method="post" class="logout">
                <button class="logout_button" type="submit" name="logout">LOGOUT</button>
            </form>
            <form class="delete_user" action="db.php" method="post">
                <?php $user = $_SESSION['username']?>
                <button class="delete_button" type="submit" name="remove" value="<?php echo $user; ?>">DELETE ACOUNT</button>
            </form>        
        </div>
    </div>
</body>
</html>