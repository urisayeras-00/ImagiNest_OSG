<?php
session_start();
    include "connection.php";
    include "functions.php";
    
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="login">
        <div class="login-triangle"></div>

        <h2 class="login-header">
        <i class="fas fa-camera-retro"></i>
        </img>IMAGINEST</h2>

        <form method="post" class="login-container">

            <p><input type="text" name="user_name" placeholder="Username"></p>
            <p><input type="password" name="password" placeholder="Password"></p>
            <button type="button" class="btn btn-primary" 
            style="display:flex; margin-left:auto; margin-right:auto; border:none; background:transparent;" 
            data-toggle="modal" data-target="#changePassword">
                <a style="color:grey;padding:5px; margin-top:-5px;">Forgot your Password?</a>
            </button>
            <p><input type="submit" value="Log in"></p>

            <p class="login-singup">Don’t have account yet? <a href="./signup.php">Sign Up!</a></p>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="resetPasswordSend.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change your password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="text" name="mail" placeholder="email" required="required" />
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block btn-large">Send email</button>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<!-- Modal -->
</body>
</html>

<!--
----------------------------------------------------------------------------
------------------------------------ DUBTES --------------------------------
----------------------------------------------------------------------------
    Falta login per mail
-->
