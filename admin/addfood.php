<?php
include_once ('connect.php');
include('../dbcon.php');
include('../global.php');
include('../bootstrap.php');
include('header3.php');
    // $ci=$_GET['ci'];
    // $co=$_GET['co'];
    // $rt=$_GET['rt'];
    // $nr=$_GET['nr'];

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
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap" rel="stylesheet">

</head>
<style>
.h1 {
    text-align: center;
    /* margin-top: 20px; */
}

body::before {
    position: absolute;
    content: "";
    height: 100%;
    width: 100%;
    z-index: -1;
    opacity: 0.89;
    background: url('../img/l6.webp') center center/cover no-repeat;
}

.delux-insert {
    height: 310px;
    width: 490px;
    border-radius: 10px;
    /* background-color:transperent; */
    margin-top: 100px;
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
    color:white;
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
</style>

<body>

    <?php  

            function search_food($id)
            {
                $conn=connection();
                $str="select * from addfood  where id=$id";
                // $str="select * from emp where empid=$eid";
                $result1=$conn->query($str);
                return $result1;
            }

            function update($id,$food_name,$food_type,$food_detail,$food_price,$target_file)
            {
                $conn=connection();
                $str="update addfood set name='$food_name',foodtype='$food_type',detail='$food_detail',price='$food_price',img='$target_file' where id=$id";
                $conn->query($str);
                $conn->close();
            }

            $id=$fname=$ftype=$det=$pri=$img="";
            if(isset($_GET['fid1']))//code for update
            {
            $result1=search_food($_GET['fid1']);
            $row=$result1->fetch_assoc();
                $id=$row["id"];
                $fname=$row["name"];
                $ftype=$row["foodtype"];
                $det=$row["detail"];
                $pri=$row["price"];
                $img=$row["img"];
            }

        
            if(isset($_POST["submit"]))//code insert
            {   
                $food_name=$_POST['food_name'];
                $food_type=$_POST['food_type'];
                $food_detail=$_POST['food_detail'];
                $food_price=$_POST['food_price'];
                $target_file = null;
                if (isset($_FILES['image1'])) 
                {
                    $file_name = $_FILES['image1']['name'];
                    $file_tmp = $_FILES['image1']['tmp_name'];
                    $target_file = basename($file_name);
                    $target_path = '../uploads/'. $file_name;
                    $target_path_to_admin = './uploads/'.$file_name;
                    copy($file_tmp, $target_path);
                    copy($file_tmp, $target_path_to_admin);
                }
                
                    
                    $qry="INSERT INTO `addfood`(name,foodtype,detail,price,img) VALUES ('$food_name','$food_type','$food_detail',$food_price,'$target_file')";
                    $run=mysqli_query($sql,$qry);
            }

            if(isset($_POST['update'])) //code update
            {
                $food_name=$_POST['food_name'];
                $food_type=$_POST['food_type'];
                $food_detail=$_POST['food_detail'];
                $food_price=$_POST['food_price'];
                $target_file = null;
                if (isset($_FILES['image1'])) 
                {
                    $file_name = $_FILES['image1']['name'];
                    $file_tmp = $_FILES['image1']['tmp_name'];
                    $target_file = basename($file_name);
                    $target_path = '../uploads/'. $file_name;
                    $target_path_to_admin = './uploads/'.$file_name;
                    copy($file_tmp, $target_path);
                    copy($file_tmp, $target_path_to_admin);
                    // copy($file_tmp, $target_path);
                }
                
                update($id,$food_name,$food_type,$food_detail,$food_price,$target_file);
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
                               Food Added Successfully.
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
                               Food Updated Successfully.
                            </div>
                            <div class="modal-footer">
                                <button form="myform" type="submit" class="btn btn-secondary" name="submit">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


    <!-- <h1> Food insert Section</h1> -->
    <div class="imgg"></div>

    <div class="delux-insert">
        <form action="addfood.php" method="post" enctype="multipart/form-data" id="myform">
            <table>

                <tr>
                    <td>Food Name</td>
                    <td><input type="text" name="food_name" required title="fname"  value=<?php echo $fname; ?>></td>
                </tr>
                <tr>
                    <td>Food Type</td>
                    <td>
                        <select name="food_type">
                            <option value="Chinese">Chinese</option>
                            <option value="South Indian">South Indian</option>
                            <option value="Italian">Italian</option>
                            <option value="Maharashtrian">Maharashtrian</option>
                            <option value="Punjabi">Punjabi</option>
                            <option value="Deserts">Deserts</option>
                            <!-- <option value="Cold">Cold</option> -->
                        </select>
                    </td>

                </tr>
                <tr>
                    <td>Food Description</td>
                    <td><input type="text" name="food_detail" required title="detail"  value=<?php echo $det; ?> > </td>
                </tr>
                <tr>
                    <td>Food Price</td>
                    <td><input type="text" name="food_price" required  title="price"  value=<?php echo $pri; ?>></td>
                </tr>
                <tr>
                    <td>Food image</td>
                    <td>
                        <center><input type="file" name="image1" required></center>
                        <div class="button"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                    <button id="submit" type="button" data-toggle="modal" data-target="#saved" name="x" class="enter">Submit</button>
                    </td>
                    <!-- <td>
                    <button id="update" type="button" data-toggle="modal" data-target="#saved1" class="enter" name="x1  ">update</button>
                    </td> -->
                </tr>
            </table>
        </form>
    </div>
</body>

</html>