<?php
error_reporting(0);
include('connection.php');
session_start();

$date = date_create_from_format("d/m/Y",$_SESSION['date']);
// $newDate = date("Y-m-d", strtotime($_SESSION['date']));  
$newDate = date_format($date, "Y-m-d");

var_dump($newDate);
// var_dump($newDate1);
var_dump($_SESSION['roomid']);
var_dump($_SESSION);


$qry = "INSERT INTO `room booking` (`r_id`, `cin`,`cout`) VALUES ('$_SESSION[roomid]','$newDate','$newDate1')";
if (mysqli_query($con, $qry)) {
   $one = true;
}
else {
   $one = false;
}

$user = "SELECT * FROM `registered_users` where `username` = '$_SESSION[username]'";
$users = mysqli_query($con, $user);
$u = mysqli_fetch_assoc($users);

$hall = "SELECT * FROM `room booking` where `r_id` = '$_SESSION[roomid]' and `cin` = '$newDate' and `cout`='$newDate1'";
$halls = mysqli_query($con, $hall);
$h = mysqli_fetch_assoc($halls);
var_dump($h);


// $qry1 = "INSERT INTO `room_details` (`username`, `roombookingid`,`members`) VALUES ('$u[username]','$h[id]','$_SESSION[npeople]')";


if (mysqli_query($con, $qry1)) {
   $two = true;
}
else {
   $two = false;
}

if($one==true && $two==true)
{
   header("location:printroombill.php");
}





?> 
