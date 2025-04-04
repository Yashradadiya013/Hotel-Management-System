<?php
include 'connection.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
function sendMail($email, $reset_token)
{
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings

        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'noreply.myhotel106@gmail.com'; //SMTP username
        $mail->Password = 'hybeymxjykprcgjn'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply.myhotel106@gmail.com', 'Hotel Management Systems');
        $mail->addAddress($email); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Password Reset Link from Krushal';
        $mail->Body = "We got a request from you to reset password! <br>
        Click The link Below:  <br>
        <a href='http://localhost/final/restaurent-management-system-master/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
// TODO
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {
    $qry = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email]'";
    $result = mysqli_query($con, $qry);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("y-m-d");
            $qry = "UPDATE registered_users SET resettoken='$reset_token',resettokenexpire='$date' WHERE email ='$_POST[email]'";
            if (mysqli_query($con, $qry) && sendMail($_POST['email'], $reset_token)) {
                echo "
                <script>
                  alert('Password reset link send to email');
                  window.location.href='index.php';
                </script>

                ";
            } else {
                echo "
                <script>
                  alert('Server Down Try Again later');
                  window.location.href='index.php';
                </script>

                ";
            }
        } else {
            echo "
            <script>
              alert('Invalid Email Entered');
              window.location.href='index.php';
            </script>

            ";
        }

    } else {
        echo "
        <script>
          alert('Cannot run');
          window.location.href='index.php';
        </script>

        ";
    }
}
