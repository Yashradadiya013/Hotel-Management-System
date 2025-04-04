<?php
if(isset($_POST['book']))
{
    session_start();
    $_SESSION['cin'] = $_POST['cin'];
    $_SESSION['cout'] = $_POST['cout'];
    $_SESSION['npeople'] = $_POST['npeople'];
    var_dump($_SESSION);
    header("location:cartpayment2.php");

}
?>
