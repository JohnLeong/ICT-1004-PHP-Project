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
        if(!isset($_SESSION['name'])){
            header('Location: index.php');
        }
        ?>
        
        <?php
        
        $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $pID = $_POST["productID"];
            $sql = "SELECT * FROM p5_2.products WHERE product_ID =$pID";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $id = $_SESSION['zid'];
                
//            saveProductToCartDB($id, $pID, $row[image], $row[product_name], $row[unit_price], $row[colour], $row[size]);
//                            
                }
        }
//        function saveProductToCartDB() {
//            global $id, $pID, $image, $pname, $unit_price, $colour, $size, $success;
//            $sql = "INSERT INTO p5_2.shoppingcart (zmember_id,product_ID, product_name, unit_price, colour, size)";
//            $sql .= " VALUES ('$id', '$pID', '$image', '$pname', '$unit_price', '$colour', '$size')";
//            // Execute the query
//            if (!$conn->query($sql)) {
//                $errorMsg = "Database error: " . $conn->error;
//                $success = false;
//            }
//        }
            
        ?>
        
        <main>
            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                    </tr>
                                </thead>
                                
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
                                                        echo "<span class='text-muted'>Size: </span> $row[unit_price]";
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        echo "<td class='text-right font-weight-semibold align-middle p-4'>SGD $row[unit_price] </td>";
                                        ?>
                                        <td class="align-middle p-4"><input type="text" class="form-control text-center" value="1"></td>
                                        <?php
                                        echo "<td class='text-right font-weight-semibold align-middle p-4'>SGD $row[unit_price] </td>";
                                        ?>
                                        <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove" onclick="delCartItem(1)">×</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->

                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4">
                                <label class="text-muted font-weight-normal">Enter Promo Code Here:</label>
                                <input type="text" placeholder="Promo Code" class="form-control">
                            </div>
                            <div class="d-flex">
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Discount</label>
                                    <div class="text-large"><strong>SGD 0.00</strong></div>
                                </div>
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Shipping Fee</label>
                                    <div class="text-large"><strong>SGD 18.00</strong></div>
                                </div>
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <div class="text-large"><strong>SGD 679</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="button" class="btn btn-lg btn-secondary md-btn-flat mt-2 mr-3" onclick="goBack()">Back to shopping</button>
                            <button type="button" class="btn btn-lg btn-secondary mt-2">Checkout</button>
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