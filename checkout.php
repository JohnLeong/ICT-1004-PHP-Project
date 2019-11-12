<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - Shopping Cart</title>
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
        ?>
        <main>
            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Checkout</h2>
                    </div>
                    <?php
                    global $grandtotal, $total;
                    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
                    // Check connection
                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    } else {
                        $id = $_SESSION['zid'];
                        $sql = "SELECT * FROM zshoppingcart WHERE zmember_id =$id";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0">
                                        <thead>
                                            <tr>
                                                <!-- Set columns width -->
                                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                                <th class="text-center py-3 px-4" style="width: 100px;">Price</th>
                                                <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                                <th class="text-center py-3 px-4" style="width: 100px;">Total</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tbody id="carttab">
                                                <tr id="row1">
                                                    <td class="p-4">
                                                        <div class="media align-items-center">
                                                            <?php
                                                            echo "<img src='$row[image]' class='d-block ui-w-40 ui-bordered mr-4' alt=$row[product_name]>";
                                                            ?>
                                                            <div class="media-body">
                                                                <?php
                                                                echo "<p class='d-block text-dark'>$row[product_name]</p>";
                                                                ?>
                                                                <small>
                                                                    <?php
                                                                    echo "<span class='text-muted'>Size: </span> $row[size]";
                                                                    echo "<span class='text-muted'>&nbsp;&nbsp; Colour: </span> $row[colour]";
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    echo "<td class='text-right font-weight-semibold align-middle p-4'>SGD $row[unit_price] </td>";
                                                    echo "<td class='align-middle p-4'>"
                                                    . "<input type='text' disabled name='qty' class='form-control text-center' value='" . $row['quantity'] . "'>"
                                                    . "</td>";

                                                    $total = $row['unit_price'] * $row['quantity'];
                                                    echo "<td class='text-right font-weight-semibold align-middle p-4'>SGD $total </td>";
                                                    ?>
                                                </tr>
                                            </tbody>
                                            <?php
                                            $grandtotal += $total;
                                        }
                                    } else {
                                        echo "<span class='cartempty'>Your Cart is Empty!!!</span>";
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->
                        <div>
                            <?php
                            $psql = "SELECT * FROM p5_2.zenith_members WHERE zmember_id='$id'";

                            // Execute the query
                            $data = $conn->query($psql);
                            if ($result->num_rows > 0) {
                                $pData = $data->fetch_assoc();
                                $email = $pData["email"];
                                $mobile = $pData["mobile"];
                                $address = $pData["address"];
                            }
                                ?>
                            <div class="checkoutdetail row float-left ">
                                <form class="text-left" name="updateShipping" action="<?php echo htmlspecialchars("editprof_process.php"); ?>" onsubmit="return validateForm()" method="POST">
                                    <h4 class="mx-3">Shipping Details</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email">Email:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="mobile">Mobile:</label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="email" value="<?php echo $email ?>" required>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="tel" name="mobile" pattern="[0-9]{8}" value="<?php echo $mobile ?>">
                                        </div>
                                    </div><br/>
                                    <div class="row py-0 mx-3">
                                        <label for="email">Shipping Address:</label>
                                        <input class="form-control" type="text" name="address" id="address" value="<?php echo $address ?>">
                                    </div>
                                    <button class="btn btn-outline-dark mt-2 mx-3" name="login_submit" type="submit">Update <i class="far fa-edit"></i></button>
                                </form>
                            </div>
                            <div class="row float-right">
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Shipping Fee</label>
                                    <?php
                                    $shippingfee = 18;
                                    if ($grandtotal == 0) {
                                        $shippingfee = 0;
                                        $grandtotal = 0;
                                    } else if ($grandtotal < 300) {
                                        $grandtotal = $grandtotal + $shippingfee;
                                    } else {
                                        $shippingfee = 0;
                                        $grandtotal = $grandtotal + $shippingfee;
                                    }
                                    echo "<div class='text-large'><strong>SGD $shippingfee</strong></div>";
                                    ?>
                                </div>
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <?php
                                    echo "<div class='text-large'><strong>SGD $grandtotal</strong></div>";
                                    ?>
                                </div>
                            </div>
                            <div class="row float-right">
                                <button type="button" class="btn btn-lg btn-secondary md-btn-flat mt-2 mr-3" onclick="window.location.href = 'shoppingcart.php'">Back to Cart</button>
                                <button type="button" class="btn btn-lg btn-secondary mt-2">Payment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include 'inc/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>