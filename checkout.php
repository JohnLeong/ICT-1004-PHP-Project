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
                <main>
                    <div class="container px-3 my-5 clearfix">
                        <!-- Shopping cart table -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Checkout</h2>
                            </div>

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
                                        header("Location: shoppingcart.php?error");
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
                            <div class="row">
                                <form class="text-left" name="update" action="<?php echo htmlspecialchars("editprof_process.php"); ?>" onsubmit="return validateForm()" method="POST">
                                    <h4 class="mx-3">Shipping Details</h4>
                                    <hr class="mx-3">
                                    <div class="row pt-0">
                                        <div class="col-6">
                                            <label for="email">Email:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="mobile">Mobile:</label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="cemail" value="<?php echo $email ?>" required>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="tel" name="cmobile" pattern="[0-9]{8}" value="<?php echo $mobile ?>">
                                        </div>
                                    </div><br/>
                                    <div class="row py-0 mx-3">
                                        <label for="email">Shipping Address:</label>
                                        <input class="form-control" type="text" name="caddress" id="address" value="<?php echo $address ?>">
                                    </div>
                                    <input type="hidden" name="cart" value="1">
                                    <button class="btn btn-outline-dark mt-2 ml-3" name="updateShipping" type="submit">Update&nbsp;<i class="far fa-edit"></i></button>

                                </form>
                            </div>
                        </div>

                        <div class="row ">
                            <form class="col-7 px-0" action="inc/checkout_process.php" method="post" name="checkoutpayment">
                                <h4 class="px-3">Credit Card Details</h4>
                                <hr class="ml-3 mb-0">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="inner-addon right-addon">
                                            <label>Card Holder</label>
                                            <i class="far fa-user"></i>
                                            <input id="card-holder" type="text" placeholder="Name" pattern="[A-Za-z]{1.}" class="form-control" required>
                                        </div>	
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Expiration Date</label>
                                        <div class="input-group">
                                            <select class="form-control" name="mm" required>
                                                <option selected="selected">MM</option>
                                                <?php
                                                // Populating the month array
                                                $months = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

                                                // Iterating through the MM array
                                                foreach ($months as $months) {
                                                    ?>
                                                    <option value="<?= $months ?>"><?= $months ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <h5 class="mt-1">&nbsp;&nbsp;/&nbsp;&nbsp;</h5>
                                            <select class="form-control" name="yy" required>
                                                <option selected="selected">YY</option>
                                                <?php
                                                // Populating the year array
                                                $years = array("19", "20", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");

                                                // Iterating through the YY array
                                                foreach ($years as $years) {
                                                    ?>
                                                    <option value="<?= $years ?>"><?= $years ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group py-0 mb-0 ">
                                    <div class="inner-addon right-addon col-6">
                                        <label>Card Number</label>
                                        <i class="far fa-credit-card"></i>
                                        <input id="card-number" type="text" class="form-control" placeholder="Card Number" pattern="[0-9]{16}" required>
                                    </div>	
                                    <div class="form-group col-4">
                                        <label>CVC</label>
                                        <input id="cvc" type="text" class="form-control" placeholder="CVC" pattern="[0-9]{3}" required>
                                    </div>
                                </div>
                                <button type="submit" name="paynow" class="btn btn-outline-dark mt-0 ml-3">Pay Now&nbsp;<i class="far fa-money-bill-alt"></i></button>
                            </form>	
                        </div>
                        <hr class="mx-3">
                        <div class="row mx-3 pt-0">
                            <button type="button" class="btn btn-md btn-secondary md-btn-flat mt-2 mr-3" onclick="window.location.href = 'shoppingcart.php'">Back to Cart</button>
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