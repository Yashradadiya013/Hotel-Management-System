<?php
if(isset($_POST['book']))
{
    session_start();
    $_SESSION['cdate'] = $_POST['cdate'];
    $_SESSION['odate'] = $_POST['odate'];
    $_SESSION['nofroom'] = $_POST['nofroom'];
    var_dump($_SESSION);
    header("location:cartpayment2.php");

}
?>
