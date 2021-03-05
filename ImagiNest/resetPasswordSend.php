<?php
    use PHPMailer\PHPMailer\PHPMailer;
    session_start();
    require_once('connection.php');

    $emailPost = $_POST["mail"];

    $query = "select * from userstable where mail = '$emailPost' or username = '$emailPost' limit 1";
    $result = mysqli_query($con, $query);

    //$usuaris->execute(array(':email'=> $_POST["mail"]));

    if(mysqli_num_rows($result) == 0) { 
        echo '<p class="error">The email address doesnt exist!</p>';
    }
    else if ($result && mysqli_num_rows($result) > 0) {
    
        $code=hash('sha256', $_POST["mail"]);

        $queryUpdate = "update userstable set resetPass=1, resetPassCode = '$code' where mail = '$emailPost' or username = '$emailPost'";
        $update = mysqli_query($con, $queryUpdate);

        /////////////////////MAIL
        
        if ($update == true){
            require 'vendor/autoload.php';

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'osgeducem@gmail.com';                  // SMTP username
                $mail->Password   = 'osgeducem123';                         // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('osgeducem@gmail.com', 'Imaginest');
                $mail->addAddress($emailPost, 'Client');                       // Add a recipient
            
            
                // Content
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = 'Imaginest - Reset your password!';
                $mail->Body = '
                <html>
                    <head>
                    </head>
                    <body>
                        <img src="https://i.ibb.co/F4SfCzM/logo.png"> <br><br>
                        <a href="localhost/ImagiNest/resetPassword.php?code='.$code.'&mail='.$emailPost.'">Change your password now!</a>
                    </body>
                </html>';

                $mail->send();
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }    
        }
        header("Location: login.php");
    }   