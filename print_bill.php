<?php
    include 'dbcon.php';
    include 'header.php';
    include 'connect.php';
    function find_qty($id)
    {
        if (isset($_SESSION['qty_array'])) {
    
            $qs = count($_SESSION['qty_array']);
    
            for ($x = 0; $x < $qs; $x++) {
                if ($_SESSION['qty_array'][$x][0] == $id) {
                    return $_SESSION['qty_array'][$x][1];
                }
            }
        }
    }
    
    $qry = "SELECT * FROM `registered_users` WHERE `username`='$_SESSION[username]'";
    $result = mysqli_query($con, $qry);
    $name = "";
    $mobile = "";
    $email = "";
    $date = date("d-m-Y");
    $transID = rand(1000000, 9999999);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            $name = $result_fetch['name'];
            $mobile = $result_fetch['mno'];
            $email = $result_fetch['email'];
            
    
        } else {
            echo "
        <script>
          alert('Incorrect Email Or Username');
          window.location.href='index.php';
        </script>
    
        ";
        }
    } else {
        echo "
    <script>
      alert('Cannot run');
      window.location.href='index.php';
    </script>
    
    ";
    }
    
    ?>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<div class="container speciality-class box-shadow-all">
    <div class="row">
        <div class="col-lg-10 bill-details box-shadow-all">
            <h1 class="h-secondary center">Hotel Management System</h1>
        </div>
        <div class="col-lg-10 bill-details order-details box-shadow-all">
            <div>
                <p class="key">Date:</p>
                <p class="value"><?=$date?></p>
            </div>
            <div>
                <p class="key">Name:</p>
                <p class="value"><?=$name?></p>
                <br />
                <p class="key">Mobile Number:</p>
                <p class="value"><?=$mobile?></p>
                <br />
                <p class="key">Email ID:</p>
                <p class="value"><?=$email?></p>
                <br />
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-2 " style="padding:0">
            <div class="table-responsive box-shadow-all">
                <table class="table table-bordered table-striped" style="margin-bottom:0">
                    <thead>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        <?php
                            //initialize total
                            $total = 0;
                            if (!empty($_SESSION['cart'])) {
                                //connection
                                $conn = connection();
                                //create array of initail qty which is 1
                                $index = 0;
                                $sql = "SELECT * FROM addfood WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
                                $query = $conn->query($sql);
                                while ($row = $query->fetch_assoc()) {
                                    ?>
                        <tr>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <?php echo number_format($row['price'], 2); ?>
                            </td>
                            <input type="hidden" name="indexes[]" value="<?php echo $row['id']; ?>">
                            <td>
                                <?php echo find_qty($row['id']) ?>
                            </td>
                            <td>
                                <?php echo number_format(find_qty($row['id']) * $row['price'], 2); ?>
                            </td>
                            <?php $total += find_qty($row['id']) * $row['price']; ?>
                        </tr>
                        <?php
                            $index++;
                            }
                            } else {
                            ?>
                        <tr>
                            <td colspan="4" class="text-center">No Item in Cart</td>
                        </tr>
                        <?php
                            }
                            
                            ?>
                        <tr>
                            <td colspan="3" align="right"><b>Total</b></td>
                            <td><b>
                                <?php echo number_format($total, 2); ?>
                                </b>
                            </td>
                        </tr>
                        <?php
                            // Adding GST
                            $gst_percentage = 18; // Change this value if GST percentage changes
                            $gst_amount = ($total * $gst_percentage) / 100;
                            ?>
                        <tr>
                            <td colspan="3" align="right"><b>GST (<?=$gst_percentage?>%)</b></td>
                            <td><b>
                                <?php echo number_format($gst_amount, 2); ?>
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><b>Total (incl. GST)</b></td>
                            <td><b>
                                <?php echo number_format($total + $gst_amount, 2); ?>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-10 bill-details box-shadow-all">
            <div>
                <p class="key">Card Number:</p>
                <p class="value">
                    <?= $_SESSION['ccnumber'] ?>
                </p> 
                <br/>
                <p class="key">Transaction ID:</p>
                <p class="value">
                    <?=$transID?>
                </p>
            </div>
        </div>
    </div>

    <!-- Rest of your HTML code -->

    <!-- JavaScript code -->
</div>

<script>
    // Your JavaScript code
</script>
<?php
    include 'footer.php';
    unset($_SESSION['cart']);
    unset($_SESSION['qty_array']);
    unset($_SESSION['ccnumber']);
?>
