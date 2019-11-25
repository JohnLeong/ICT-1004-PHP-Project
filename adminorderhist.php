<?php
include 'inc/header.php';
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
}
// Check for valid ID for admins
if (!isset($_SESSION['zid'])) {
    $id = 0;
} else {
    $id = $_SESSION['zid'];
}

// If standard user tries to access, redirect back to index
if ($id != 3) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Zenith - Order History</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--BootStrap 4 CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!--Website Main CSS-->
        <link rel="stylesheet" href="css/zenithMainStyle.css" />

        <!--Favicon for browser tab-->
        <link rel="shortcut icon" href="img/zshoe-icon.png"/>

        <!--Icons for Web-->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <h2>Order History</h2>
            <?php
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
            } else {
                if (!isset($_POST["member_select"])) {
                    $id = 0;
                } else {
                    $id = $_POST["member_select"];
                }
//                $id = $_POST["member_select"];
                $sql = "SELECT * FROM p5_2.zorder WHERE zmember_id =$id";
                $result = mysqli_query($conn, $sql);
                $orderid = array();

                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($orderid, $row['order_id']);
                }
                $forloop = 0;
                $size_orderid = sizeof($orderid);

                if ($size_orderid > 0) {
                    while ($forloop < $size_orderid) {
                        $msql = "SELECT * FROM p5_2.zorder WHERE order_id =$orderid[$forloop]";
                        $mresult = mysqli_query($conn, $msql);
                        $mrow = mysqli_fetch_assoc($mresult);

                        $oid = $mrow['order_id'];
                        $date = $mrow['date'];
                        $totalamt = $mrow['total_amt'];
                        $disc = $mrow['discount'];
                        $shipfee = $mrow['shipping_fee'];
                        $stats = $mrow['status'];
                        $recdate = $mrow['receive_date'];
                        ?>
                        <div class="container px-3 my-4 clearfix">
                            <!-- Shopping cart table -->
                            <div class="card">
                                <div class="card-header">
                                    <?php
                                    echo "<h2>Order ID: $oid</h2>";
                                    ?>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="float-left ml-3 mb-2 ls-2">
                                            <?php
                                            echo "<span><h5>Date/Time of Purchase: $date</h5></span>";
                                            echo "<span><h5>Shipping Status: $stats</h5></span>";
                                            if ($stats == 'Received') {
                                                echo "<span><h5>Received on $recdate</h5></span>";
                                            }
                                            ?>
                                        </div>
                                        <table class="table table-bordered m-0">
                                            <thead>
                                                <tr>
                                                    <!-- Set columns width -->
                                                    <th class="text-center py-3 px-4" style="width: 300px;">Product Name &amp; Details</th>
                                                    <th class="text-center py-3 px-4" style="width: 100px;">Quantity</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $psql = "SELECT * FROM p5_2.order_details WHERE order_id ='$oid'";
                                            $presult = mysqli_query($conn, $psql);
                                            while ($prow = mysqli_fetch_assoc($presult)) {
                                                ?>
                                                <tbody id="carttab">
                                                    <tr id="row1">
                                                        <td class="p-4">
                                                            <div class="media align-items-center">
                                                                <?php
                                                                echo "<img src='$prow[image]' class='d-block ui-w-40 ui-bordered mr-4' alt=$prow[product_name]>";
                                                                ?>
                                                                <div class="media-body">
                                                                    <?php
                                                                    echo "<p class='d-block text-dark'>$prow[product_name]</p>";
                                                                    ?>
                                                                    <small>
                                                                        <?php
                                                                        echo "<span class='text-muted'>Size: </span> $prow[size]";
                                                                        echo "<span class='text-muted'>&nbsp;&nbsp; Colour: </span> $prow[colour]";
                                                                        ?>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php
                                                        echo "<td class='align-middle p-4'>"
                                                        . "<input type='text' disabled name='qty' class='form-control text-center' value='" . $prow['quantity'] . "'>"
                                                        . "</td>";
                                                        ?>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <div class="float-right">
                                                            <label class="text-muted font-weight-normal m-0">Discount:&nbsp;</label>
                                                            <br>
                                                            <label class="text-muted font-weight-normal m-0">Shipping Fee:&nbsp;</label>
                                                            <br>
                                                            <label class="text-muted font-weight-normal m-0">Total price:&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="float-left">
                                                            <?php
                                                            echo "<strong>SGD $disc</strong>";
                                                            ?><br>
                                                            <?php
                                                            echo "<span><strong>SGD $shipfee</strong></span>";
                                                            ?><br>
                                                            <?php
                                                            echo "<strong>SGD $totalamt</strong>";
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- / Shopping cart table -->
                            </div>
                        </div> <?php
                        $forloop += 1;
                    } // End while loop
                    echo "<button style='position:absolute; right:25%;' type='submit' onclick='window.history.back()' class='btn btn-outline-dark'>Back</button>";
                } else {
                    echo "You have not purchased anything.<br/>";
                    echo "<button type='submit' onclick='window.history.back()' class='btn btn-outline-dark'>Back</button>";
                }
            }
                        ?>
        </main>
        <?php
        include 'inc/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
