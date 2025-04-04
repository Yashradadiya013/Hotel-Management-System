<?php
include 'dbcon.php';
include 'header.php';
include 'connect.php';
// session_start();
$_SESSION['redirected_page'] = 'cartpayment2.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$_SESSION['bill'] = 'print_bill.php';

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

?>

<body>

<div class="container speciality-class box-shadow-all">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="h-primary center">My Cart</h1>
        </div>

        <div class="col-sm-8 col-sm-offset-2">
            <?php

            if (isset($_SESSION['message'])) {
                ?>
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php
                unset($_SESSION['message']);
            }

            ?>
            <form method="POST" action="cart/save_cart.php">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>GST</th>
                        </thead>
                        <tbody>
                        <?php
                        //initialize total
                        $total = 0;
                        $gstPercentage = 18; // Change this value as needed
                        if (!empty($_SESSION['cart'])) {
                            //connection
                            $conn = connection();
                            //create array of initial qty which is 1
                            $index = 0;
                            if (!isset($_SESSION['qty_array'])) {
                                $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), array(1, 1));
                                $cs = count($_SESSION['cart']);
                                for ($x = 0; $x < $cs; $x++) {
                                    $_SESSION['qty_array'][$x][0] = $_SESSION['cart'][$x];
                                    $_SESSION['qty_array'][$x][1] = 1;
                                }
                            } else {
                                $cs = count($_SESSION['cart']);
                                $qs = count($_SESSION['qty_array']);

                                for ($x = 0; $x < $cs - $qs; $x++) {

                                    array_push($_SESSION['qty_array'], array(1, 1));
                                }

                                for ($x = $qs; $x < $cs; $x++) {

                                    $_SESSION['qty_array'][$x][0] = $_SESSION['cart'][$x];
                                    $_SESSION['qty_array'][$x][1] = 1;

                                }
                            }
                            $sql = "SELECT * FROM addfood WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
                            $query = $conn->query($sql);
                            while ($row = $query->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="delete-btn">
                                            <a href="cart/delete_item.php?id=<?php echo $row['id'] ?>"
                                               class=" btn box-shadow-all btn-outline-danger btn-sm">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['price'], 2); ?>
                                    </td>
                                    <input type="hidden" name="indexes[]" value="<?php echo $row['id']; ?>">
                                    <td><input type="text" class="form-control"
                                               value="<?php echo find_qty($row['id']); ?>"
                                               name="qty_<?php echo $row['id']; ?>" pattern="[1-9]{1}" min="1">
                                    </td>
                                    <td>
                                        <?php echo number_format(find_qty($row['id']) * $row['price'], 2); ?>
                                    </td>
                                    <!-- Display GST for this item -->
                                    <td><?php echo number_format((find_qty($row['id']) * $row['price'] * $gstPercentage) / 100, 2); ?></td>
                                    <?php $total += find_qty($row['id']) * $row['price']; ?>
                                </tr>
                                <?php
                                $index++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">No Item in Cart</td>
                            </tr>
                            <?php
                        }

                        ?>
                        <!-- Display total and total with GST -->
                        <tr>
                            <td colspan="4" align="right"><b>Total</b></td>
                            <td><b>
                                    <?php echo number_format($total, 2); ?>
                                </b></td>
                            <td></td><!-- Leave this column empty for consistency -->
                        </tr>
                        <?php
                        // Calculate GST amount and total with GST
                        $gstAmount = ($total * $gstPercentage) / 100;
                        $totalWithGST = $total + $gstAmount;
                        ?>
                        <tr>
                            <td colspan="4" align="right"><b>Total (incl.18% GST)</b></td>
                            <td><b><?php echo number_format($totalWithGST, 2); ?></b></td>
                            <td></td><!-- Leave this column empty for consistency -->
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart-btns">
                    <a href="food.php" class="one btn btn-outline-primary box-shadow-all">
                        <i class='fa fa-arrow-left'></i>
                        Back
                    </a>
                    <button type="submit" class="two btn btn-outline-success box-shadow-all" name="save">
                        <i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" data-toggle="modal" data-target="#clearcartmodal" name="reset"
                            class="three btn btn-outline-danger box-shadow-all">
                        <i class="fa fa-trash-o"></i>
                        Clear Cart
                    </button>
                    <?php
                    if (count($_SESSION['cart']) != 0) {
                        ?>
                        <div class="four">
                            <form action="checklogin.php" method="POST">
                                <a href="checklogin.php" class="btn btn-outline-success box-shadow-all">
                                    <i class="fa fa-check"></i>
                                    Checkout
                                </a>
                            </form>
                        </div>
                        <?php
                    }
                    ?>
                </div>
