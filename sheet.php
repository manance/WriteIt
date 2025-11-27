<?php
    include 'db.php';
    
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }

    if(isset($_POST['song_button'])){
        $name = str_replace("_", " ", htmlspecialchars($_POST['song_button'], ENT_QUOTES, 'UTF-8'));
        $_SESSION['sheet_name'] = $name;
    }

    $data = json_decode(file_get_contents('music.json'), true);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet-<?php echo $_SESSION['sheet_name'];?></title>
    <link rel="stylesheet" href="css/sheet.css">
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
    <div class="sheet">
        <h1 class="sheet_name"><?php echo $_SESSION['sheet_name'];?></h1>
        <div class="chords">
            <?php
                foreach($data as $sheet){
                    if ($sheet['name'] == $_SESSION['sheet_name'] && $sheet['author'] == $_SESSION['username']){
                        if(isset($sheet['chord']) && is_array($sheet['chord'])){
                            foreach ($sheet['chord'] as $chord){
                                echo "<div class='chord'>" . htmlspecialchars($chord, ENT_QUOTES, 'UTF-8') . "</div>";
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>
    <form action="write.php" class="edit" method="post">
        <button class="edit_button" type="submit" name="edit" value="<?php echo $_SESSION['sheet_name']; ?>">EDIT</button>
     </form>
</body>
</html>