<?php
    include 'db.php';
    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write</title>
</head>
<body>
    <navbar></navbar>
</body>
</html>