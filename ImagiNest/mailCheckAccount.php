<?php
    require_once('connection.php');
    $mailGet = $_GET["mail"];
    $codeGet = $_GET["code"];

    $query = "select * from userstable where mail = '$mailGet' and activationCode = '$codeGet' limit 1";
    $result = mysqli_query($con, $query);
    if($result)
    {
        if($result && mysqli_num_rows($result) > 0)
        {
            $fechaActual = date('Y-m-d H:i:s');
            $queryUpdate = "update userstable set active=1, activationDate='$fechaActual', activationCode=NULL
                where mail='$mailGet'";
                $result = mysqli_query($con, $queryUpdate);
                header("Location: home.php");
        }
    }