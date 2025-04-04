<?php

  include('../dbcon.php');
  include('../global.php');
  include_once 'connect.php';
  include('header2.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>

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
                    <input type="number" class="form-control" id="members"  name="members"  pattern="[0-9]" >
                </div>

                <button id="submit" type="submit" name="submit">Continue</button>
            </div>
        </form>