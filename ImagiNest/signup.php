<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $verify_password = $_POST['verify_password'];

        if(!empty($user_name) && !empty($password) && $password===$verify_password)
        {
            //guardem a la bdd
            $passHash = passwordHash($password);
            $active = true;

            $querySelect = "select username from userstable where username = '$user_name' limit 1";
            $selectResult = mysqli_query($con, $querySelect);
            if($selectResult && $selectResult->num_rows==0) 
            {
                $queryInsert = "insert into userstable (mail,username,passHash,userFirstName,userLastName,active) values ('$email','$user_name','$passHash','$first_name','$last_name','$active')";
                mysqli_query($con, $queryInsert);
                header("Location: login.php");
                die; 
            }else echo "Existing username";
        }
        else{
            echo "Enter valid information!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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

                <p><input type="text" name="user_name" placeholder="Username"></p>
                <p><input type="email" name="email" placeholder="Email"></p>
                <p><input type="text" name="first_name" placeholder="First Name"></p>
                <p><input type="text" name="last_name" placeholder="Last Name"></p>
                <p><input type="password" name="password" placeholder="Password"></p>
                <p><input type="password" name="verify_password" placeholder="Verify Password"></p>

                <p><input type="submit" value="Signup"></p>

                <p class="login-singup">Click to <a href="./login.php">Login</a></p>
            </form>
        </div>
    </body>
</html>

<!--
----------------------------------------------------------------------------
------------------------------------ DUBTES --------------------------------
----------------------------------------------------------------------------
-->