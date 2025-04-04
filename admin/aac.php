<?php

  include('../dbcon.php');
  include('../global.php');
  include_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin ac room</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist\css\bootstrap.min">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap" rel="stylesheet">
    <style>
    body::before {
        position: absolute;
        content: "";
        height: 100%;
        width: 100%;
        z-index: -1;
        opacity: 0.89;
        object-fit: cover;
        background: url('../img/k8.jpg') center center/cover no-repeat;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
    }

    .delux-insert {
        height: 230px;
        width: 400px;
        border-radius: 10px;
        /* background-color:#a68383; */
        margin-top: -10px;
        margin-left: 38%;

    }

    .delux-insert form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-top: 30px;
    }

    .delux-insert form table tr td input {
        padding: 4px 0;
        margin-bottom: 10px;
        border-radius: 8px;
        padding-left: 10px;
    }

    .delux-insert form table tr td {
        font-size: 20px;
    }

    #delux-btn {
        width: 80%;
        background-color: #cdb1e5;
        font-size: 16px;
    }

    .imgg {
        display: flex;
        justify-content: space-evenly;
        /* justify-content:center; */
        margin-top: 10px;
    }

    img {
        width: 350px;
        /* margin-left: 100px; */
    }
    </style>
</head>

<body><?php

include ('header2.php');
include ('../bootstrap.php');


        function search_room($id)
        {
            $conn=connection();
            $str="select * from acroom where id=$id";
            // $str="select * from emp where empid=$eid";
            $result1=$conn->query($str);
            return $result1;
        }

        function update($id,$room_number,$room_type,$room_price,$room_detail,$target_file)
        {
            $conn=connection();
            $str="update acroom set roomno=$room_number,roomtype='$room_type',price=$room_price,detail='$room_detail',img='$target_file' where id=$id";
            $conn->query($str);
            $conn->close();
        }


    $id=$rno=$rname=$pri=$det=$img="";
    if(isset($_GET['fid1']))//code for update
    {
     $result1=search_room($_GET['fid1']);
     $row=$result1->fetch_assoc();
          $id=$row["id"];
          $rno=$row["roomno"];
          $rname=$row["roomtype"];
          $pri=$row["price"];
          $det=$row["detail"];
          $img=$row["img"];
    }

 
    if(isset($_POST['submit'])) // insert
    {
        $room_number=$_POST['room_number'];
        $room_type=$_POST['room_type'];
        $room_price=$_POST['room_price'];
        $room_detail=$_POST['room_detail'];
        $target_file = null;
        if (isset($_FILES['image'])) 
        {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $target_file = basename($file_name);
            $target_path = '../uploads/'. $file_name;
            $target_path_to_admin = './uploads/'.$file_name;
            copy($file_tmp, $target_path);
            copy($file_tmp, $target_path_to_admin);
            // copy($file_tmp, $target_path);
        }


            $qry="INSERT INTO `acroom`(roomno,roomtype,price,detail,img) VALUES ($room_number,'$room_type',$room_price,'$room_detail','$target_file')";
            $run=mysqli_query($sql,$qry);
    }

    if(isset($_POST['update'])) //code update
    {
        $room_number=$_POST['room_number'];
        $room_type=$_POST['room_type'];
        $room_price=$_POST['room_price'];
        $room_detail=$_POST['room_detail'];

        
        $target_file = null;
        if (isset($_FILES['image'])) 
        {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $target_file = basename($file_name);
            $target_path = '../uploads/'. $file_name;
            $target_path_to_admin = './uploads/'.$file_name;
            copy($file_tmp, $target_path);
            copy($file_tmp, $target_path_to_admin);
            // copy($file_tmp, $target_path);
        }
        
        update($id,$room_number,$room_type,$room_price,$room_detail,$target_file);
        // echo '<script>alert("updated")</script>';
    }

?>

                <div class="modal fade" id="saved" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               Room insert Successfully.
                            </div>
                            <div class="modal-footer">
                                <button form="myform" type="submit" class="btn btn-secondary" name="submit">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="saved1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               Room Update Successfully.
                            </div>
                            <div class="modal-footer">
                                <button form="myform" type="submit" class="btn btn-secondary" name="submit">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


    <h1> Rooms insert Section</h1>
    <div class="imgg"></div>

    <div class="delux-insert">
        <form method="post" enctype="multipart/form-data" id="myform">
            <table>

                <tr>
                    <td>Room No</td>
                    <td>
                        <input type="text" name="room_number" placeholder="Enter room number" required title="Enter Room No"
                        value=<?php echo $rno; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Room Type</td>
                    <td>
                        <select name="room_type" >
                            <option value="Ac" value=<?php echo $rname; ?>>AC</option>
                            <option value="Non Ac" value=<?php echo $rname; ?>>Non Ac</option>
                            <option value="Delux" value=<?php echo $rname; ?>>Delux</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Room Price</td>
                    <td><input type="text" name="room_price" placeholder="Enter Room Price " required title="Room Price"
                    value=<?php echo $pri; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Room Description</td>
                    <td><input type="text" name="room_detail" placeholder="Enter Room Desc" required title="detail"
                        value=<?php echo $det; ?>  >
                    </td>
                </tr>

                <tr>
                    <td>Room image</td>
                    <td>
                        <center><input type="file" name="image"  value=<?php echo $img; ?> required></center>

                        <div class="button">

                        </div>
                    </td>
                </tr>
                <tr>
                <td>
                <button id="submit" type="button" data-toggle="modal" data-target="#saved" name="x" class="enter">Submit</button>
                </td>
                <td>
                <button id="update" type="submit" data-toggle="modal" data-target="#saved1" class="enter" name="update">Update</button>
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
