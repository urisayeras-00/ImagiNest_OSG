<?php
session_start();
    include "connection.php";
    include "functions.php";
    include "db_query.php";
    
    check_session($con);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (!empty($user_name) && !empty($password)) {

            $query = "select * from userstable where username = '$user_name' limit 1";

            $result = mysqli_query($con, $query);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    if((password_verify($password,$user_data['passHash'])) && ($user_data['active']=="1"))
                    {
                        $id = $_SESSION['user_id'] = $user_data['iduser'];
                        $user_name = $_SESSION['username'] = $user_data['username'];
                        //$user_data['lastSignIn'] = getTimestamp();
                        header("Location: home.php");
                        die;
                    }
                }
            }
            echo "Wrong username or password";
        } else {
            echo "Enter valid information!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
    <body>
        <div class="login">
            <div class="login-triangle"></div>

            <h2 class="login-header">
            <!--<img class="login-icon" src="./images/retroCam.png">-->
            <i class="fas fa-camera-retro"></i>
            </img>IMAGINEST</h2>

            <form method="post" class="login-container">

                <p><input type="text" name="user_name" placeholder="Email"></p>
                <p><input type="password" name="password" placeholder="Password"></p>

                <p><input type="submit" value="Log in"></p>

                <p class="login-singup">Don’t have account yet? <a href="./signup.php">Sign Up!</a></p>
            </form>
        </div>
    </body>
</html>

<!--
----------------------------------------------------------------------------
------------------------------------ DUBTES --------------------------------
----------------------------------------------------------------------------
    Falta login per mail
-->
