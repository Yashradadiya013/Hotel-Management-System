<?php
include('../dbcon.php');
$rno=$_GET['rno'];
if(mysqli_query($sql,"UPDATE `acroom` SET `status`='true' WHERE `roomno`='$rno'  and cout='$cout' "))
{
    header('location:aroom.php');
}
?>