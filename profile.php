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
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div><?php echo $_SESSION['username'];?></div>
    <form action=" " method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <form class="delete_user" action="db.php" method="post">
        <?php $user = $_SESSION['username']?>
        <button class="delete_button" type="submit" name="remove" value="<?php echo $user; ?>">DELETE ACOUNT</button>
    </form>
</body>
</html>