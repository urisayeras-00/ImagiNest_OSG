<?php
function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from userstable where iduser = '$id' limit 1";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // si no pasa res d'això, fem redirect al login
    header("Location: login.php");
    die;
}
function check_session($con)
{
    if(isset($_SESSION['user_id']))
    {
        header("Location: home.php");
        die;
    }    
}
function passwordHash($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}