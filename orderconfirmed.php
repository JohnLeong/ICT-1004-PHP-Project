<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Order Confirmation</title>
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
        <?php
        include 'inc/header.php';
        if (!isset($_SESSION['name'])) {
            header('Location: index.php');
        }
        if (isset($_GET['success'])) {
            echo '<script type="text/javascript">alert("You have successfully placed your order!");</script>';
        } else {
            header('Location: index.php?404');
        }
        ?>
        <main>
        <?php
        global $grandtotal, $total;
        $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $i = 0;
            $id = $_SESSION['zid'];
            $sql = "SELECT * FROM p5_2.zorder WHERE zmember_id =$id ORDER BY order_id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    $oid = $row['order_id'];
                    $date = $row['date'];
                    $totalamt = $row['total_amt'];
                    $disc = $row['discount'];
                    $shipfee = $row['shipping_fee'];
                    $stats = $row['status'];
            ?>
            <div class="container px-3 my-2 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Order Success!</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="float-left ml-3 mb-2 ls-2">
                                <?php
                                echo "<span><h5>Order ID: $oid</h5></span>";
                                echo "<span><h5>Date/Time of Purchase: $date</h5></span>";
                                echo "<span><h5>Shipping Status: $stats</h5></span>";
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
                                $lastsql = "SELECT order_id FROM p5_2.order_details ORDER BY order_id DESC LIMIT 1";
                                $lastresult = mysqli_query($conn, $lastsql);
                                $lastrow = mysqli_fetch_assoc($lastresult);
                                $lastid = $lastrow['order_id'];
                                $tsql = "SELECT * FROM p5_2.order_details WHERE order_id =$lastid";
                                $tresult = mysqli_query($conn, $tsql);
                                while ($trow = mysqli_fetch_assoc($tresult)) {
                                ?>
                                <tbody id="carttab">
                                    <tr id="row1">
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <?php
                                                echo "<img src='$trow[image]' class='d-block ui-w-40 ui-bordered mr-4' alt=$trow[product_name]>";
                                                ?>
                                                <div class="media-body">
                                                    <?php
                                                    echo "<p class='d-block text-dark'>$trow[product_name]</p>";
                                                    ?>
                                                    <small>
                                                        <?php
                                                        echo "<span class='text-muted'>Size: </span> $trow[size]";
                                                        echo "<span class='text-muted'>&nbsp;&nbsp; Colour: </span> $trow[colour]";
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        echo "<td class='align-middle p-4'>"
                                        . "<input type='text' disabled name='qty' class='form-control text-center' value='" . $trow['quantity'] . "'>"
                                        . "</td>";
                                        ?>
                                    </tr>
                         <?php  } ?>
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
                            <div>
                                <button type="button" class="btn btn-md btn-secondary md-btn-flat float-right my-3 mx-2" onclick="window.location.href = 'orderhistory.php'">Order History </button>
                                <button type="button" class="btn btn-md btn-secondary md-btn-flat float-right my-3" onclick="window.location.href = 'index.php'">Back Home </button>
                            </div>
                        </div>
                    </div> <!-- / Shopping cart table -->
                </div>   
            </div>
        <?php } 
        else {
                echo "You have not purchased anything.";
            }
        }?>
        </main>
        <?php
        include 'inc/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
