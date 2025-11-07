<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Title font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">

    <!-- text font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <box class="box">
        <header class="header">
            <h1 class="title">WriteIt</h1>
        </header>
        <register class="register">
            <form class="form" action="db.php" method="post">
                <article class="text">LOGIN!</article>
                <div class="inputs">
                    <input class="input" type="text" placeholder="username" name="username" required>
                    <input class="input" type="password" placeholder="password" name="password" required>
                </div>
                <div class="buttons">
                    <a class="button" href="index.php">Register</a>
                    <button class="button" type="submit" name="login">Login</button>                    
                </div>
                <div class="error">
                </div>
            </form>
        </register>
    </box>   
</body>
</html>