<?php
    if(!isset($_GET['email']) || !isset($_GET['activationCode'])) {
        header('Location: register.php');
        exit();
    } else {
        
        $email = $_GET['email'];
        $activationCode = $_GET['activationCode'];

    }
?>