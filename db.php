<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "writeit";
    $conn = "";

    try{

        $conn = mysqli_connect($db_server,
                               $db_user,
                               $db_password,
                               $db_name);
                               
    }catch(mysqli_sql_exception){

        echo "Could not connect to database!";

    }

    function registerUser($conn, $flname, $username, $email, $password){

        $id = 0;
        $query = "SELECT * FROM users";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){

            foreach($query_run as $row){

                $id = $row['id'] + 1;

            }
        }else{

            $id = 0;

        }
        $users = "SELECT username FROM users WHERE username='$username'";
        $users_run = mysqli_query($conn, $users);
        if(mysqli_num_rows($users_run) > 0){
            session_start();
            $_SESSION['error'] = "Username already exists!";
            header ("Location: index.php");
            exit();
        }else{
            $stmt = $conn->prepare("insert into users(id, flname, username, email, password) values (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $id, $flname, $username, $email, $password);
            $stmt->execute();
            $stmt->close();
            session_start();
            $_SESSION['username'] = $username;
            header ("Location: home.php");            
        }

    }

    function loginUser($conn, $username, $password){

        $query = "SELECT * FROM users WHERE username='" . $username . "'";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){

            $row = mysqli_fetch_array($query_run);

            if(password_verify($password, $row['password'])){

                return TRUE;

            }else{

                return FALSE;

            }
        }
    }

    
    if(isset($_POST['register'])){

        $flname = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        registerUser($conn, $flname, $username, $email, $password);

    }elseif(isset($_POST['login'])){

        // $flname = $_POST['name'];
        $username = $_POST['username'];
        // $email = $_POST['email'];
        $password = $_POST['password'];

        if(loginUser($conn, $username, $password) == TRUE){

            session_start();
            $_SESSION['username'] = $username;
            header ("Location: home.php");

        }else{
            session_start();
            $_SESSION['error'] = "Invalid username or password!";
            header ("Location: login.php");
            exit();
        }
    }

    $json = json_decode(file_get_contents('music.json'), true);
    
    if(isset($_POST['remove'])){
        deleteUser($_POST['remove'], $json);
    }

    function deleteUser($username, $json){

        echo $username;

        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "writeit";
        $connection = "";

        $conn = new mysqli($server, $user, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if($json != null){
            foreach($json as $i => $song){
                if($song['author'] == $username){
                    unset($json[$i]);
                }
            }
        }
        file_put_contents('music.json', json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $deletion = "DELETE FROM users WHERE username='$username'";
        if($conn->query($deletion) === TRUE){
            header("Location: index.php");
        }
        session_destroy();
    }
?>
