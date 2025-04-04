<?php
    include('dbcon.php');
    include 'connect.php';
    $conn = connection();
    include 'header.php';

    // add your print bill file name
    $_SESSION['bill'] = 'printroombill.php';
    // Check connection
    if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
    }
    ?>
<!-- TODO -->
<?php 
    // when the user press book button in room.php
    // store that room id in session

     // there is no column named r_id in room bokking table
     // but kindly add that column
     // because it is necessary to select the room while booking
     $acroomTbl = "SELECT * FROM `room booking` where `r_id` = $_SESSION[roomid]";
             $acrooms = mysqli_query($sql, $acroomTbl);
             $row=mysqli_num_rows($acrooms);
             $datesf = array();
    
             if($row > 0)
             {
                 while ($row = mysqli_fetch_assoc($acrooms)) {
                     $newDate = $row['cin'];  
                     
                     array_push($datesf, $newDate);
    
                     $newDate1 = $row['cout'];  
                     
                     array_push($datesf, $newDate1);
                 }            
             }
    ?> 
<!DOCTYPE html>
<html lang="en">

<head lang="en">
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

        <title>ac room form</title>
        <!-- TODO copy- kindly put the php tag before script tag and script tag before html code-->

        <script>
            var dates = <?php echo json_encode($datesf); ?>;

            console.log(dates);
            $(document).ready(function(){
            elem = document.getElementById("cout1");
            elem1 =document.getElementById("cout2");

            

            var date = new Date();
            date.setHours(date.getHours() + 5);
            date.setMinutes(date.getMinutes() + 30);

            var iso = date.toISOString();

            var minDate = iso.substring(0,iso.length-8);
            elem.value = minDate;
            elem.min = minDate;
            elem1.value = minDate;
            elem1.min = minDate;

            console.log(elem.value);

            elem.addEventListener("change", (event) => {
                let date1 = new Date(event.target.value);

                for(var i=0; i<dates.length;i+=2)
                {
                    var sd = new Date(dates[i]);
                    var ed = new Date(dates[i+1]);

                    if(sd <= date1 && date1 <= ed)
                    {
                        document.getElementById("modalbody").innerHTML = "The room is booked between " + dates[i] + " and " + dates[i+1];
                        $('#dateinvalid').modal('show');
                        return;
                    }
                }

                var date2 = new Date(elem1.value);
                if(date1 <= date2)
                {
                    document.getElementById("modalbody").innerHTML = "checkout date must be after checkin date";
                    $('#dateinvalid').modal('show');
                    return;
                }
                
            });

            elem1.addEventListener("change", (event) => {
                let date1 = new Date(event.target.value);

                for(var i=0; i<dates.length;i+=2)
                {

                    var sd = new Date(dates[i]);
                    var ed = new Date(dates[i+1]);

                    if(sd <= date1 && date1 <= ed)
                    {
                        document.getElementById("modalbody").innerHTML = "The room is booked between " + dates[i] + " and " + dates[i+1];
                        $('#dateinvalid').modal('show');
                    }
                }
                
            });


            });


        </script>
    </head>
    <?php 
        // when the user press book button in room.php
        // store that room id in session
         //$_SESSION['roomid'] =167;
        
        
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
        ?>
    <style>
        #r1-container {
            position: relative;
        }
        #r1-container h1 {
        text-align: center;
        margin-top: 30px;
        }
        form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        }
        table {
        width: 200px;
        height: 150px;
        border: 1px solid black;
        /* background-color:red; */
        background-color: rgba(255, 255, 255, 0.5);
        padding: 40px;
        border-radius: 20px;
        }
        table tr td {
        padding: 8px;
        }
        table tr td input {
        font-size: 17px;
        }
    </style>
    <body>
        <div id="r1-container">
            <?php
                $conn = connection();
                $loginUsername = $_SESSION['username'];
                $sql = "SELECT * FROM `registered_users` WHERE username = '$loginUsername'";
                $loginUser = $conn->query($sql);
                
                if ($loginUser->num_rows > 0) {
                    // output data of each row
                    while ($row = $loginUser->fetch_assoc()) {
                        ?>
            <!-- <form action="r1.php" method="post"> -->
              

            <form id="myform" action="r1.php" method="POST" >

            <div style="margin-top:20px" class="cardc box-shadow-all">

                <a class="singup">Room Booking Form</a>

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" readonly name="name"
                    value=<?php echo (isset($row['username']) && $row['username'] != null) ? $row['username'] : "" ?>>
                </div>
                <div class="form-group">
                    <label for="datetime-local">Check In Date</label>
                    <input type="datetime-local" class="form-control" 
                        onselect="onCheckinChange()" id="cout2" name="intime">
                </div>
                <div class="form-group">
                    <label for="datetime-local">Check out Date</label>
                    <input type="datetime-local" class="form-control" 
                    onselect="onCheckinChange()" id="cout1" name="outtime">
                </div>
                <div class="form-group">
                    <label for="members">Members</label>
                    <input type="number" class="form-control" id="members"  name="members"  pattern="[1-3]{1}" max="3" >
                </div>
                <!-- <div class="inputBox1">
                    <input type="datetime-local" class="js--datePicker" id="cin" name="cin" value="" required="required" autocomplete="false">
                    <span>Check In Date</span>
                </div>
                <div class="inputBox1">
                    <input type="datetime-local" class="js--datePicker" id="cout" name="cout" value="" required="required" autocomplete="false">
                    <span>Check Out Date</span>
                </div>
                <div class="inputBox1">
                    <input type="number" class="total-persons" id="npeople" name="npeople" value="" required="required" autocomplete="false">
                    <span>Members</span>
                </div> -->
                <!-- <div class="inputBox1">
                    <input type="number" class="js--datePicker" id="noofroom" name="noofroom" value="" required="required" autocomplete="false">
                    <span>No Of Rooms</span>
                </div> -->
                <button id="submit" type="submit" name="submit">Continue</button>
            </div>
        </form>
                <?php
                    function book_room($rid)
                    {
                        $conn = connection();
                        $str = "select * from registered_users ";
                        $result1 = $conn->query($str);
                        return $result1;
                    }
                    
                    $username = "";
                    if (isset($_GET['rid1']))//code for order
                    {
                        $result1 = book_room($_GET['rid1']);
                        $row = $result1->fetch_assoc();
                        // $id=$row["id"];
                        $username = $row["username"];
                        // $pri=$row["med_price"];
                    }
                    
                    if (isset($_POST['submit'])) {
                        $name = $_POST['name'];
                        $cin = $_POST['intime'];
                        $cout = $_POST['outtime'];
                        $members = $_POST['members'];

                        // TODO
                        $str = $_POST['intime'];
                        $str1 = $_POST['outtime'];

                        $str = substr($str,0,10) . " " . substr($str,11,5). ":00";
                        $str1 = substr($str1,0,10) . " " . substr($str1,11,5). ":00";


                        $_SESSION['post'] = ($_POST);

                        // it is in your session so use that
                        $rid =133;
                        $_SESSION['post']['intime'] = $str;
                        $_SESSION['post']['outtime'] = $str1;

                    
                        $qry = "SELECT * FROM acroom";
                        $run = mysqli_query($conn,$qry);
                        // $rno=$ow['roomno'];
                        $row = mysqli_fetch_assoc($run);
                        $rno = $row['roomno'];
                    
                    
                        // query change according to your table
                        $qry="INSERT INTO `room booking` (`id`, `r_id`, `name`, `cin`, `cout`,`members`) VALUES (NULL,'$rid', '$name', '$str', '$str1', '$members');";
                    
                        $run = mysqli_query($conn, $qry);
                    
                    
                        if ($run == true) {
                            mysqli_query($conn,"UPDATE `acroom` SET `status`='book' WHERE `roomno`='$rno' ");
                            echo "<script>
                                 window.location.href='cartpayment2.php';
                                 </script>";
                             ?>
                <!-- <script>
                    alert("room book Successfully");
                    </script> -->
                <?php
                    } else {
                    
                    }
                    }
                    ?>
            </form>
            <?php
                }
                } else {
                echo "0 results";
                }
                ?>
        </div>

        <!-- TODO add the modal -->
        <div class="modal fade" id="dateinvalid" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Place choose different date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
<?php
    include('footer.php');
?>