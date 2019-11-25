<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <?php
        //Constants for accessing our DB
        define("DBHOST", "161.117.122.252");
        define("DBNAME", "p5_2");
        define("DBUSER", "p5_2");
        define("DBPASS", "yzhbGyqP87");
        global $rsuccess;
        $rsuccess = true;

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $url_components = parse_url($url);
            parse_str($url_components['query'], $params);
            $params['productID'] = sanitize_input($params['productID']);
            $proID = sanitize_input($params['productID']);
            // Prepare
            $stmt = $conn->prepare("SELECT * FROM p5_2.products WHERE product_ID =?");
            // Bind
            $stmt->bind_param("i", $params['productID']);
            // Execute
            $stmt->execute();
        }
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<title>Zenith - " . $row["product_name"] . "</title>";
        }
        $result->free_result();

        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = preg_replace('/[^0-9]/', '', $data);
            return $data;
        }
        ?>
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

        <!--Font Awesome-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <script>
        function validateForm() {
            var maxchar = 500;
            var wordcount = 0;
            var reviews = document.forms["reviewForm"]["reviewbox"].value;

            if (reviews == null || reviews == "") {
                alert("Review Box is empty!");
                return false;
            } else if (reviews.length > 500) {
                alert("Review must be between 1 to 500 characters!");
                return false;
            }
        }
    </script>
    <body>
        <?php
        include "inc/header.php";
        if (isset($_GET['nostock'])) {
            echo '<script type="text/javascript">alert("Unable to add to cart, as there is not enough stock.");</script>';
        }

        if (isset($_GET['productID'])) {
            $getparams = $_GET['productID'];
            if (preg_match("/(RSuccess)/", $getparams)) {
                echo '<script type="text/javascript">alert("Review Submitted Successfully!");</script>';
            } else if (preg_match("/(RFailed)/", $getparams)) {
                echo '<script type="text/javascript">alert("Submission Failed!");</script>';
            }
        }
        ?>
        <main>
            <!-- Product Details-->
            <div class="container" id="product-section">
                <div class="row">
                    <div class="col-md-6"><!--Product Image-->
                        <?php
                        getProdDB();
                        getReviewsDB();
                        $success = true;

                        function getProdDB() {
                            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                            global $rsuccess;
                            $rsuccess = true;
                            // Check connection
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                $url_components = parse_url($url);
                                parse_str($url_components['query'], $params);
                                // Prepare
                                $stmt = $conn->prepare("SELECT * FROM p5_2.products WHERE product_ID =?");
                                // Bind
                                $stmt->bind_param("i", $params['productID']);
                                // Execute
                                $stmt->execute();
                            }
                            $result = $stmt->get_result();
//                            $row = $result->fetch_assoc();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<img class='productimgresize' src='" . $row["image"] . "' alt='" . $row["product_name"] . "'/>";
                                ?>
                            </div><!--End of Product Image-->
                            <div class='col-md-6'><!--Product Info-->
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <?php
                                        echo "<h2>" . $row["product_name"] . "</h2>";
                                        ?>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <?php
                                        echo "<p class='description'>" . $row["product_desc"] . "</p>";
                                        ?>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 bottom-rule'>
                                        <?php
                                        echo "<h2 class='product-price'>$" . $row["unit_price"] . "</h2>";
                                        ?>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='input-group mb-3'>
                                        <form method='post' action='inc/update_shoppingcart.php' name='addtocart'>
                                            <select name='shoe_select'>
                                                <?php
                                                $stmt = $conn->prepare("SELECT * FROM p5_2.product_details WHERE product_ID =?");
                                                $stmt->bind_param("i", $params['productID']);
                                                $stmt->execute();
                                                $resultShoe = $stmt->get_result();

                                                for ($i = 0; $i < $resultShoe->num_rows; ++$i) {
                                                    $rowDetail = $resultShoe->fetch_assoc();
                                                    if ((int) $rowDetail["stock"] > 0) {
                                                        echo "<option value='" . $rowDetail["productDetail_ID"] . ":" . $rowDetail["colour"] . ":" . $rowDetail["size"] . ":" . $rowDetail["stock"] . "'>" . $rowDetail["colour"] . " : " . $rowDetail["size"] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <br />
                                            <br />
                                            <input type='hidden' name='productname' value='" . $row["product_name"] . "' class='form-control'>
                                            <input type='hidden' name='price' value='" . $row["unit_price"] . "' class='form-control'>
                                            <input type='hidden' name='img' value='" . $row["image"] . "' class='form-control'>
                                            <div class='input-group-append'>
                                                <button class="btn btn-success btn-md" name="addtocart" type="submit" id="addcart">
                                                    <i class = "fa fa-cart-plus"></i>&nbsp;&nbsp; Add to Cart!</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                $resultShoe->free_result();
                            } else {?>
                                <h4>Product does not exist!</h4>
                                <input class="btn btn-default" type="button" value="Back To Shopping" 
                                       onclick="window.location.href = 'index.php'" /> 
                                       <?php
                                       $rsuccess = false;
                                   }
                                   $result->free_result();
                                   $conn->close();
                               }

                               function getReviewsDB() {
                                   global $zmemb, $pid, $date, $errorMsg, $reviews, $numOfReviews;
                                   $reviews = array();
                                   $zmemb = array();
                                   $date = array();
                                   $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                                   // Check connection
                                   if ($conn->connect_error) {
                                       $errorMsg = "Connection failed: " . $conn->connect_error;
                                       $success = false;
                                   } else {
                                       $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                       $url_components = parse_url($url);
                                       parse_str($url_components['query'], $params);
                                       $pid = sanitize_input($params['productID']);
                                       // SQL Statement
                                       $sql = "SELECT R.product_ID, M.fname, M.lname, R.reviews, R.datetime ";
                                       $sql .= "FROM p5_2.products_review R, p5_2.zenith_members M ";
                                       $sql .= "WHERE R.zmember_id = M.zmember_id ";
                                       $sql .= "AND R.product_ID = " . $pid . " ";
                                       $sql .= "ORDER BY datetime ASC";
                                       $stmt = $conn->prepare("SELECT R.product_ID, M.fname, M.lname, R.reviews, R.datetime "
                                               . "FROM p5_2.products_review R, p5_2.zenith_members M"
                                               . " WHERE R.zmember_id = M.zmember_id "
                                               . "AND R.product_ID = ? "
                                               . "ORDER BY datetime ASC");
                                       $stmt->bind_param("i", $params['productID']);
                                       $stmt->execute();
                                       $result = $stmt->get_result();

                                       if ($result != null) {
                                           $numOfReviews = $result->num_rows;

                                           if ($result->num_rows > 0) {
                                               for ($i = 0; $i < $numOfReviews; $i++) {
                                                   $row = $result->fetch_assoc();
                                                   $reviews[$i] = $row["reviews"];
                                                   $zmemb[$i] = $row["fname"] . " " . $row["lname"];
                                                   $date[$i] = $row["datetime"];
                                               }
                                           } else {
                                               $success = false;
                                           }
                                       } else {
                                           $success = false;
                                       }
                                   }
                                   $conn->close();
                               }
                               ?>
                        <!-- Product Description Collapsible Panel-->
                        <div class="row product-description">
                            <div class="col-md-12">
                                <div class="wrapper center-block">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <?php
                                                        if ($rsuccess) {
                                                            echo "Reviews";
                                                        }
                                                        ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <?php
                                                if ($rsuccess) {
                                                    echo "<div class='panel-body'>";
                                                    for ($i = 0; $i < $numOfReviews; $i++) {
                                                        echo $reviews[$i];
                                                        echo "<br>";
                                                        echo "- " . $zmemb[$i] . " @ " . $date[$i];
                                                        echo "<hr>";
                                                    }
                                                    echo "</div>";
                                                }
                                                ?>
                                            </div>
                                            <div class="panel-body">
                                                <br>
                                                <?php
                                                if ($rsuccess == 1) {
                                                    ?>
                                                    <form name="reviewForm" action="<?php echo htmlspecialchars('inc/review_process.php') ?>" method="POST" onsubmit="return validateForm()">
                                                        <p>Leave your review here! (Max 500 Characters)</p>
                                                        <input type="hidden" name="prodID" value="<?php echo $pid ?>">
                                                        <textarea rows="4" cols="50" name="reviewbox" id="reviewbox"></textarea>
                                                        <label id="count"></label>
                                                        <button type="submit" class="btn btn-outline-dark" id="rvwBtn">Submit</button>
                                                        <script>document.getElementById('reviewbox').onkeyup = function () {
                                                                document.getElementById('count').innerHTML = "Characters left: " + (500 - this.value.length);
                                                            };</script>
                                                    </form>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--End of Product Collapsible Panel-->
                    </div><!--End of row-->
                </div><!--End of container-->
            </div><!-- End of Product Details-->
        </main>
        <?php
        include "inc/footer.php"
        ?>

        <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>