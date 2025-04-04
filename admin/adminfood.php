<?php
 include('../dbcon.php');
 include('header3.php');
 include('../bootstrap.php');
 include('connect.php');
$conn = connection();
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Food</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist\css\bootstrap.min">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&family=Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap" rel="stylesheet">

</head>
<style>
    .table {
    width: 100%;
    margin-bottom: 1rem;
    color: white;
    }
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
    background: url('../img/l4.webp') center center/cover no-repeat;
    }
    .admin-booking table tr{
        /* color:white; */
        font-size:20px;
        font-family: 'Rubik', sans-serif;
    }
</style>
<body>
<div class="table-responsive">
        <h1 class="admin-book" align="center">Welcome Admin To Booking <Section></Section></h1>
        <table class="table">
            <tr align="center">
                    <th width="10%" height="50px">Name</th>
                     <th width="10%" height="50px">Email</th>
                     
                     <!-- <th width="10%" height="50px">No Of rooms</th> -->

            </tr>
            <?php
               $qry="SELECT * FROM `registered_users`";
               $run=mysqli_query($sql,$qry);
                
                 while( $row=mysqli_fetch_assoc($run))
                 {
                    $name=$row['name'];
                    $email=$row['email'];

                    ?>
                    <tr>
                     <td width="10%" height="50px"><center><?php echo $name; ?></center></td>
                     <td width="10%" height="50px"><center><?php echo $email; ?></center></td>
                     <!-- <td width="10%" height="50px"><center></center></td> -->
                     
                 </tr>

                    <?php
                 }
            ?>
        </table>
    </div>             
</body>
</html>