<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "imaginest";

    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
    {
        die("Fail to connect to Data Base!");
    }
?>

<!--
----------------------------------------------------------------------------
    - Conecta a la base de dades
----------------------------------------------------------------------------
-->