<?php

include('dbcon.php');
include 'connect.php';
include('header.php');
// session_start();
// var_dump($_SESSION);

$conn = connection();
// Check connection
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head lang="en">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>


<!-- TODO -->
<?php 

   // when the user press book button in room.php
   // store that room id in session
    // $_SESSION['roomid'] = 133;


    // there is no column named r_id in room bokking table
    // but kindly add that column
    // because it is necessary to select the room while booking
        $acroomTbl = "SELECT * FROM `room booking` where `r_id` = $_SESSION[roomid]";
            $acrooms = mysqli_query($sql, $acroomTbl);
            $row=mysqli_num_rows($acrooms);
            $datesf = array();
            $datesk = array();

            if($row > 0)
            {
                while ($row = mysqli_fetch_assoc($acrooms)) {
                    $newDate = date("d/m/Y", strtotime($row['cin']));  
                    
                    array_push($datesf, $newDate);

                    $newDate1 = date("d/m/Y", strtotime($row['cout']));  
                    
                    array_push($datesk, $newDate1);
                }            
            }
            $user = "SELECT * FROM `registered_users` where `username` = '$_SESSION[username]'";
            $users = mysqli_query($sql, $user);
            $u = mysqli_fetch_assoc($users);

            $qry="SELECT * FROM `acroom` WHERE `id`=$_SESSION[roomid]";
            $run=mysqli_query($sql,$qry);
            $rd =  mysqli_fetch_assoc($run);
            // $capacity = intval($rd['capacity']);
?> 


    <!-- TODO copy- kindly put the php tag before script tag and script tag before html code-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
   var dates = <?php echo json_encode($datesf); ?>;
   var dates1 = <?php echo json_encode($datesk); ?>;

   function DisableDates(date) {
   var string = jQuery.datepicker.formatDate("dd/mm/yy", date);
   return [dates.indexOf(string) == -1];
   }

   function DisableDates1(date) {
   var string = jQuery.datepicker.formatDate("dd/mm/yy", date);
   return [dates1.indexOf(string) == -1];
   }
   $(function() {
   $("#cin").datepicker({
    beforeShowDay: DisableDates,
    minDate: 0,
    dateFormat: "dd/mm/yy",
    onSelect: function (date) {
                var date2 = $('#cin').datepicker('getDate');
                $('#cout').datepicker('setDate', date2);
                $('#cout').datepicker('option', 'minDate', date2);
            }
   });
   });

   $(function() {
   $("#cout").datepicker({
    beforeShowDay: DisableDates1,
    minDate: 0,
    dateFormat: "dd/mm/yy"
   });
   });
</script>
<!-- copy till here -->
</head>

<?php 

   // when the user press book button in room.php
   // store that room id in session
    // $_SESSION['roomid'] = 133;


    // there is no column named r_id in room bokking table
    // but kindly add that column
    // because it is necessary to select the room while booking
    // $acroomTbl = "SELECT * FROM `room booking` where `r_id` = $_SESSION[roomid]";
    //         $acrooms = mysqli_query($sql, $acroomTbl);
    //         $row=mysqli_num_rows($acrooms);
    //         $datesf = array();
    //         $datesk = array();

    //         if($row > 0)
    //         {
    //             while ($row = mysqli_fetch_assoc($acrooms)) {
    //                 $newDate = date("d/m/Y", strtotime($row['cin']));  
                    
    //                 array_push($datesf, $newDate);

    //                 $newDate1 = date("d/m/Y", strtotime($row['cout']));  
                    
    //                 array_push($datesk, $newDate1);
    //             }            
    //         }
?>

<body>
<div id="r1-container">
    <?php
    $conn = connection();
    // session_start();
    $loginUsername = $_SESSION['username'];
    $sql = "SELECT * FROM `registered_users` WHERE username = '$loginUsername'";
    $loginUser = $conn->query($sql);

    if ($loginUser->num_rows > 0) {
        // output data of each row
        while ($row = $loginUser->fetch_assoc()) {
            ?>

        <form id="myform" action="r1ins" method="POST" >
            <div style="margin-top:20px" class="cardc box-shadow-all">
                <a class="singup">Room Booking Form</a>
                <div class="inputBox1">
                    <input type="text" class="js--datePicker" id="cin" name="cin" value="" required="required" autocomplete="false">
                    <span>Check In Date</span>
                </div>
                <div class="inputBox1">
                    <input type="text" class="js--datePicker" id="cout" name="cout" value="" required="required" autocomplete="false">
                    <span>Check Out Date</span>
                </div>
                <div class="inputBox1">
                    <input type="number" class="js--datePicker" id="npeople" name="npeople" value="" required="required" autocomplete="false">
                    <span>Members</span>
                </div>
                <!-- <div class="inputBox1">
                    <input type="number" class="js--datePicker" id="noofroom" name="noofroom" value="" required="required" autocomplete="false">
                    <span>No Of Rooms</span>
                </div> -->
                <button id="submit" type="submit" name="book" class="enter">Continue</button>
            </div>
        </form>

      <?php
        }
    }
      ?>

</div>
</body>
</html>
<?php
    include('footer.php');
?>