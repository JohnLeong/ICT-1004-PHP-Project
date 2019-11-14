<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith</title>
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

//        if (isset($_GET['mailing_error'])) {
//            echo '<script type="text/javascript">alert("An error has occured. Please try again.");</script>';
//        }
//        if (isset($_GET['mailing_success'])) {
//            echo '<script type="text/javascript">alert("You have been added to the mailing list!");</script>';
//        }
        ?>
        <main>
            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Order Confirmed</h2>
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
                         <?php  } ?>
                                    <tr>
                                        <?php 
                                            global $discount, $shippingfee, $grandtotal, $final;
                                            $disc = $_POST["discount"];
                                            $shipfee = $_POST["shippingfee"];
                                            $finalp = $_POST["final"];
                                        ?>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="float-right">
                                                <h6 class="mb-1">Payment Details</h6>
                                                <label class="text-muted font-weight-normal m-0">Discount:&nbsp;</label>
                                                <br>
                                                <label class="text-muted font-weight-normal m-0">Shipping Fee:&nbsp;</label>
                                                <br>
                                                <label class="text-muted font-weight-normal m-0">Total price:&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="float-left mt-4">
                                                <?php
                                                echo "<strong>SGD $disc</strong>";
                                                ?><br>
                                                <?php
                                                echo "<span><strong>SGD $shipfee</strong></span>";
                                                ?><br>
                                                <?php
                                                echo "<strong>SGD $finalp</strong>";
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- / Shopping cart table -->
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
