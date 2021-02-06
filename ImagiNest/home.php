<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    /*if(isset($_SESSION['username'])){
      
   }*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="./css/home.css">
  <title>Home</title>
</head>
<body>
  <header class="showcase">
    <div class="container showcase-inner">
      <h1>Welcome to ImagiNest <?php echo $_SESSION['username']?>!</h1> <!--Si el nom no fos exactament igual pel motiu que fos, saltaria un error de PHP-->
      <a href="./logout.php" class="btn">Log Out</a>
    </div>
  </header>
</body>
</html>