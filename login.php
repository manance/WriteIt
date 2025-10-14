<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <form action="db.php" method="post">
        <input type="text" placeholder="username" name="username" required>
        <input type="password" placeholder="password" name="password" required>
        <a href="index.php">Register</a>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>