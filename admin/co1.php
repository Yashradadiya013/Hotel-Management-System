<?php
include('../dbcon.php');
$rno=$_GET['rno'];
if(mysqli_query($sql,"UPDATE `hall` SET `status`='not book' WHERE `hallyype`='$hallyype' "))
{
    header('location:halldetail.php');
}
?>