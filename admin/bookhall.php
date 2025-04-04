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
        background: url('../img/hall4.webp') center center/cover no-repeat;
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

include ('header4.php');
include ('../bootstrap.php');

        function search_hall($id)
        {
            $conn=connection();
            $str="select * from hall where id=$id";
            // $str="select * from emp where empid=$eid";
            $result1=$conn->query($str);
            return $result1;
        }

        function update($id,$Hall_no,$Hall_type,$Hall_price,$hall_detail,$target_file,$hall_capacity)
        {
            $conn=connection();
            $str="update hall set hno=$Hall_no,hallyype='$Hall_type',price=$Hall_price,detail='$hall_detail',image='$target_file',capacity=$hall_capacity where id=$id";
            $conn->query($str);
            $conn->close();
        }

        $id=$hno=$hname=$pri=$det=$image=$capa="";
        if(isset($_GET['fid1']))//code for update
        {
         $result1=search_hall($_GET['fid1']);
         $row=$result1->fetch_assoc();
              $id=$row["id"];
              $hno=$row["hno"];
              $hname=$row["hallyype"];
              $pri=$row["price"];
              $det=$row["detail"];
              $image=$row["image"];
              $capa=$row["capacity"];

        }

if(isset($_POST['submit']))
{
    $Hall_no=$_POST['Hall_no'];
    $Hall_type=$_POST['Hall_typ'];
    $Hall_price=$_POST['Hall_price'];
    $hall_detail=$_POST['hall_detail'];
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
    $hall_capacity=$_POST['hall_capacity'];


        $qry="INSERT INTO `hall`(hno,hallyype,price,detail,image,capacity) VALUES ($Hall_no,'$Hall_type',$Hall_price,'$hall_detail','$target_file','$hall_capacity')";
        $run=mysqli_query($sql,$qry);
    }

    if(isset($_POST['update']))
    {
        $Hall_no=$_POST['Hall_no'];
        $Hall_type=$_POST['Hall_typ'];
        $Hall_price=$_POST['Hall_price'];
        $hall_detail=$_POST['hall_detail'];
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
        $hall_capacity=$_POST['hall_capacity'];

        update($id,$Hall_no,$Hall_type,$Hall_price,$hall_detail,$target_file,$hall_capacity);

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
                               Hall insert Successfully.
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
                               Hall Update Successfully.
                            </div>
                            <div class="modal-footer">
                                <button form="myform" type="submit" class="btn btn-secondary" name="submit">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

    <h1> Hall insert Section</h1>
    <div class="imgg"></div>

    <div class="delux-insert">
        <form method="post" enctype="multipart/form-data" id="myform">
            <table>
                <tr>
                    <td>Hall No</td>
                    <td><input type="text" name="Hall_no"  required placeholder="Enter Hall No" title="Room Price"
                    value=<?php echo $hno; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Event</td>
                    <td>
                        <select name="Hall_typ">
                            <option value="Marriage">Marriage</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Baby Shower">Baby Shower</option>
                            <option value="Engagement">Engagement</option>
                            <option value="Annual Function">Annual Function</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Hall Price</td>
                    <td><input type="text" name="Hall_price" placeholder="Enter Hall Price "  required title="Room Price"
                        value=<?php echo $pri; ?>  >
                    </td>
                </tr>
                <tr>
                    <td>Hall Description</td>
                    <td><input type="text" name="hall_detail" placeholder="Enter Hall Desc " required  title="detail"
                            value=<?php echo $det; ?>  >
                    </td>
                </tr>

                <tr>
                    <td>Hall image</td>
                    <td>
                        <center><input type="file" name="image" 
                            value=<?php echo $image; ?> required></center>

                        <div class="button">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Hall Capacity</td>
                    <td><input type="text" name="hall_capacity" placeholder="Enter Hall Cap" required title="capacity"
                            value=<?php echo $capa; ?>  >
                    </td>
                </tr>
                <tr>
                <td>
                <button id="submit" type="button" data-toggle="modal" data-target="#saved" name="x" class="enter">Submit</button>
                </td>
                <td>
                <button id="update" type="submit" data-toggle="modal" data-target="#saved1" class="enter"  name="update">Update</button>
                </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html