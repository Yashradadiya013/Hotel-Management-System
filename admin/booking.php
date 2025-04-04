<?php
 include('../dbcon.php');
 include('../bootstrap.php');
 include('connect.php');
 include('header2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Room</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist\css\bootstrap.min">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&family=Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    .admin-booking{
        background:rgba(255,255,255,0.5); 
        
    }
    .admin-booking h1{
        text-align:center;
        margin-top: 20px;
    }
    body::before{
    position: absolute;
    content: "";
    height: 900px;
    width: 100%;
    z-index: -1;
    opacity: 0.89;
    background: url('../img/k6.jpg') center center/cover no-repeat;
    }
    .admin-booking table tr{
        font-size:20px;
        font-family: 'Rubik', sans-serif;
    }
</style>
<body></body>

<div class="table-responsive">
        <h1 class="admin-book" align="center">Welcome Admin To Booking <Section></Section></h1><br><br>
        <table class="table">
            <tr align="center">
                    <th width="10%" height="50px">Name</th>
                     <th width="10%" height="50px">Check In Date</th>
                     <th width="10%" height="50px">Check Out Date</th>
                     <th width="10%" height="50px">Members</th>
                     <!-- <th width="10%" height="50px">Room Type</th> -->
                     <!-- <th width="10%" height="50px">No Of rooms</th> -->
                     <th width="10%" height="50px">Check Out</th>


            </tr>
     <?php

                

                function delete($id)
                {
                    $conn=connection();
                        $str="delete from `room booking` where id=$id";
                        $conn->query($str);
                        $conn->close();
                        
                }

                if(isset($_GET['fid']))//code for delete
                {
                    delete($_GET['fid']);
                }


               $qry="SELECT * FROM `room booking`";
               $run=mysqli_query($sql,$qry);
                
                 while( $row=mysqli_fetch_assoc($run))
                 {
                    $name=$row['name'];
                    // $address=$row['address'];
                    // $state=$row['state'];
                    // $city=$row['city'];
                    // $email=$row['email'];
                    $ci=$row['cin'];
                    $co=$row['cout'];
                    $members=$row['members'];
                    // $roomtype=$row['roomtype'];
                    // $noofroom=$row['no of rooms'];

                    ?>
                    <tr align="center">
                     <td width="10%" height="50px"><center><?php echo $name; ?></center></td>
                    <td width="10%" height="50px"><center><?php echo $ci; ?></center></td>
                     <td width="10%" height="50px"><center><?php echo $co; ?></center></td>
                     <td width="10%" height="50px"><center><?php echo $members; ?></center></td>
                     <!-- <td width="10%" height="50px"><center><?php echo $noofroom; ?></center></td> -->
                     <td><a href="booking.php?fid=<?php echo $row["id"];?>"?>Delete</a></td>
                     <!-- <td width="10%" height="50px"><center></center></td> -->
                     
                 </tr>

                    <?php
                 }
            ?>
        </table>
    </div>
</body>
</html>