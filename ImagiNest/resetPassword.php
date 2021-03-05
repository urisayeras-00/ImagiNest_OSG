<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password == $password2) {

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $resetPassCode = $_POST["code"];
        $email = $_POST["email"];

        $query = "select * from userstable where mail = '$email' and resetPassCode = '$resetPassCode'";

        $result = mysqli_query($con, $query);
        //$usuaris->execute(array(':email' => $_POST["mail"], ':resetPassCode' => $_POST["code"]));

        if ($result && mysqli_num_rows($result) > 0) {

            $queryUpdate = "update userstable set passHash='$password_hash', resetPass=0, resetPassCode = NULL where mail = '$email' or username = '$email'";
            $result = mysqli_query($con, $queryUpdate);
            header("Location: login.php");
        } 
        else {
            echo "error";
        }
    } else {
        echo "la contrasenya ha de ser igual";
    }
}
else{
    $resetPassCode = $_GET["code"];
    $email = $_GET["mail"];
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="./css/login.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="login">
	<h1>Change your password</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <input type="password" name="password" placeholder="Password" required="required" />
        <input type="password" name="password2" placeholder="confirm Password" required="required"/>
        <input type="text" style="display: none" name="email" value="<?php echo $email?>">
        <input type="text" style="display: none" name="code" value="<?php echo $resetPassCode?>">
        <button type="submit" class="btn btn-primary btn-block btn-large">Submit</button>
    </form>
</div>

</body>

</html>
