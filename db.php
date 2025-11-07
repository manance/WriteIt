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

        $stmt = $conn->prepare("insert into users(id, flname, username, email, PASSWORD) values (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id, $flname, $username, $email, $password);
        $stmt->execute();
        $stmt->close();
        session_start();
        $_SESSION['username'] = $username;
        header ("Location: home.php");
    }

    function loginUser($conn, $username, $password){

        $query = "SELECT * FROM users WHERE username='$username'";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){

            $row = mysqli_fetch_array($query_run);

            if(password_verify($password, $row['PASSWORD'])){

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
            
            $error = 1;

        }
    }
?>