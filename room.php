<?php

error_reporting(0);
include('header.php');
include('global.php');
include_once('dbcon.php');
include ('connection.php');

$_SESSION['redirected_page'] = 'r1.php';
$_SESSION['roomid'] = 0;
$_SESSION['bill'] = 'print_bill.php';

?>


<html>

<head lang="en">
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <style>
        .room-status {
            display: none;
        }
    </style>
</head>

<div id="room-home">
    <figure>
        <img src="img/n15.jpg" alt="delux">
        <img src="img/acroom2.jpg" alt="delux">
        <img src="img/b5.jpg" alt="delux">
        <img src="img/ad1.jpg" alt="delux">
        <img src="img/ac2.jpeg" alt="delux">
    </figure>
</div>
<form action="" method="post">
    <section class="content ">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row ">

                    <?php
                    $r  = $_GET['room'];
                    $ci = $_GET['ci'];
                    $co = $_GET['co'];


                    $acroomTbl1 = "SELECT * FROM `acroom`";
                    $acrooms1  = mysqli_query($sql, $acroomTbl1);
                    $row       = mysqli_num_rows($acrooms1);
                    if ($row > 0)
                    {
                        while ($row = mysqli_fetch_assoc($acrooms1))
                        {
                            ?>
                            <div class="col-md-6 mt-5">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5 class=""><?php echo ucfirst($row['roomtype']); ?></h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <ol class="nav nav-pills nav-sidebar flex-column float-sm-right">
                                                    <li class="breadcrumb-item">
                                                    <a href="addr1.php?id=<?php echo $row['id']; ?>">
                                                        <button type="button"
                                                                class="btn btn-sm bg-info btn-tool" name="room-btn"
                                                                id="room-btn">
                                                            Book
                                                        </button>
                                                    </a>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="<?php echo getBaseUrl() . '/uploads/'.$row['img'] ?>"
                                                     class="card-img" alt="Room image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <strong>Description:</strong> <?php echo $row['detail'] ?></p>
                                                    <p class="card-text">
                                                        <!-- <strong>Status:</strong> <?php echo $row['status'] ?></p> -->
                                                    <p class="card-text">
                                                        <strong>Price:</strong> <?php echo $row['price'] ?> Rs</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>

                        <div class="col-md-4 mt-5">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <p class="card-text">
                                                    <strong>Sorry Please come another day, currently not available
                                                        room.</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>


    </section>

</form>
</div>


<div class="room-status">

    <section id="rooms-right">

    </section>
    <section id="rooms-right">

    </section>
    <section id="rooms-right">

    </section>
</div>


<?php
include('headfooter.php');
?>

</body>

</html>

