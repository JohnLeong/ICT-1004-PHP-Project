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
    header('Location: account.php');
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
        <title>Zenith - Admin Page</title>
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

        <!-- JQuery for Shadow Effect -->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script type="text/javascript">
            function incrementValue(val) {
                var value = parseInt(document.getElementById('updatestock').value);
                value = isNaN(value) ? 0 : value;
                value = value + val;
                document.getElementById('updatestock').value = value;
            }
            $(document).ready(function () {
                // executes when HTML-Document is loaded and DOM is ready
                console.log("document is ready");


                $(".card").hover(
                        function () {
                            $(this).addClass('shadow-lg').css('cursor', 'pointer');
                        }, function () {
                    $(this).removeClass('shadow-lg');
                }
                );
                // document ready  
            });

        </script>
    </head>
    <body>
        <?php
        $editChoice = 0;
        $success = $getsuccess = $dsuccess = true;
        $prodid = 0;

        // GET from URL for edit choice for admin Either PROD or MEMB
        if (!isset($_GET['edit'])) {
            $editChoice = "";
        } else {
            $editChoice = $_GET['edit'];
        }

        // POST from form to get either value of 1,2,3
        if (!isset($_POST["prodid"])) {
            $prodid = 0;
        } else {
            $prodid = $_POST["prodid"];
        }
//        // Check if membDel if active for admin to delete member
        if (!isset($_POST["viewHistMembBtn"])) {
            $membHist = 0;
        } else {
            $membHist = $_POST["viewHistMembBtn"];
        }

        // POST result for PRODID, 1 = Insert, 2 = Delete, 3 = Insert Product Detail
        if ($prodid == 1) {
            insertProduct();
        } else if ($prodid == 2) {
            deleteProduct();
        } else if ($prodid == 3) {
            insertProductDetail();
        } else if ($prodid == 4) {
            updateStock();
        }

        // POST result for MEMBDEL, 1 = delete, 0 = ignore
//        if ($membDel == 1) {
//            deleteMember();
//        }
        // Sanitize Function
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Get Zenith Members Info
        function getMembersInfo() {
            global $zidArr, $fnameArr, $lnameArr, $emailArr, $lastloginArr, $getsuccess, $error;
            $zidArr = $fnameArr = $lnameArr = $emailArr = $lastloginArr = array();

            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $getsuccess = false;
            } else {
                $stmt = $conn->prepare("SELECT zmember_id ,fname,lname, email, lastlogin FROM p5_2.zenith_members");
                // Execute the query
                $stmt->execute();
                // Execute the query
                $result = $stmt->get_result();

                if ($result != null) {
                    $numOfMemb = $result->num_rows;

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $numOfMemb; $i++) {
                            $row = $result->fetch_assoc();
                            $zidArr[$i] = $row["zmember_id"];
                            $fnameArr[$i] = $row["fname"];
                            $lnameArr[$i] = $row["lname"];
                            $lastloginArr[$i] = $row["lastlogin"];
                            $emailArr[$i] = $row["email"];
                        }
                    } else {
                        $getsuccess = false;
                    }
                } else {
                    $getsuccess = false;
                }
                $result->free_result();
            }
            $conn->close();
        }

        function getProductInfo() {
            global $pidArr, $prodnameArr, $getsuccess, $error;
            $pidArr = $prodnameArr = array();

            define("DBHOST", "161.117.122.252");
            define("DBNAME", "p5_2");
            define("DBUSER", "p5_2");
            define("DBPASS", "yzhbGyqP87");

            $success = true;

            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $getsuccess = false;
            } else {
                // Prepare and bind
                $stmt = $conn->prepare("SELECT * FROM p5_2.products");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result == TRUE) {
                    
                } else {
                    $error .= $conn->error;
//                    echo "<h1>$error</h1>";
                }
                // Execute the query
                if ($result != null) {
                    $numOfProds = $result->num_rows;

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $numOfProds; $i++) {
                            $row = $result->fetch_assoc();
                            $pidArr[$i] = $row["product_ID"];
                            $prodnameArr[$i] = $row["product_name"];
                        }
                    } else {
                        $error .= $conn->error;
                        $getsuccess = false;
                    }
                } else {
                    $error .= $conn->error;
//                    echo "<h1>$error</h1>";
                    $getsuccess = false;
                }
                $result->free_result();
            }
            $conn->close();
        }

        function getProductDet() {
            global $upidArr, $uprodNameArr, $getsuccess, $error, $pdidArr, $ecolourArr, $esizeArr, $estockArr;
//            $pid = $_POST["product_select"];
            $upidArr = $uprodNameArr = $pdidArr = $ecolourArr = $esizeArr = $estockArr = array();
            define("DBHOST", "161.117.122.252");
            define("DBNAME", "p5_2");
            define("DBUSER", "p5_2");
            define("DBPASS", "yzhbGyqP87");

            $success = true;

            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $getsuccess = false;
            } else {
                // Prepare and bind
                $stmt = $conn->prepare("SELECT D.productDetail_ID, D.product_ID, D.colour, D.size, D.stock, P.product_name FROM p5_2.product_details D , p5_2.products P where P.product_ID = D.product_ID");
                $stmt->execute();
                $result = $stmt->get_result();

                // Execute the query
                if ($result != null) {
                    $numOfDet = $result->num_rows;

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $numOfDet; $i++) {
                            $row = $result->fetch_assoc();
                            $pdidArr[$i] = $row["productDetail_ID"];
                            $uprodNameArr[$i] = $row["product_name"];
                            $pidArr[$i] = $row["product_ID"];
                            $ecolourArr[$i] = $row["colour"];
                            $esizeArr[$i] = $row["size"];
                            $estockArr[$i] = $row["stock"];
                        }
                    } else {
                        $error .= $conn->error;
                        $getsuccess = false;
                    }
                } else {
                    $error .= $conn->error;
                    $getsuccess = false;
                }
                $result->free_result();
            }
            $conn->close();
        }

        function updateStock() {
            global $upsuccess, $error;
            $pdid = sanitize_input($_POST["product_select"]);
            $ustock = sanitize_input($_POST["updatestock"]);

            define("DBHOST", "161.117.122.252");
            define("DBNAME", "p5_2");
            define("DBUSER", "p5_2");
            define("DBPASS", "yzhbGyqP87");

            $success = true;

            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $getsuccess = false;
            } else {
                // Prepare and bind

                $stmt = $conn->prepare("UPDATE p5_2.product_details SET stock = ? WHERE productDetail_ID = ?");
                $stmt->bind_param("ii", $ustock, $pdid);
                $stmt->execute();

                // Execute the query
                if ($stmt->execute() == true) {
                    $upsuccess=true;
                    echo "<main><h1 align='center'>Stock Updated!</h1></main>";
                } else {
                    $error .= $conn->error;
                    $upsuccess=false;;
                }
            }
            $conn->close();
        }

        function insertProduct() {
            global $insertProdSuccess, $error;
            $prodid = sanitize_input($_POST["prodid"]);
            $prodname = sanitize_input($_POST["prodname"]);
            $brand = sanitize_input($_POST["brand"]);
            $desc = sanitize_input($_POST["desc"]);
            $type = sanitize_input($_POST["type"]);
            $price = sanitize_input($_POST["price"]);
            $gender = sanitize_input($_POST["gender"]);
            $image = "img/" . sanitize_input($_POST["image"]);
            $imgsrc = sanitize_input($_POST["imgsrc"]);

            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $insertProdSuccess = false;
            } else {
                $stmt = $conn->prepare("INSERT INTO p5_2.products (product_name, brand, product_desc, type, unit_price, image, image_source, gender) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->bind_param("ssssdsss", $prodname, $brand, $desc, $type, $price, $image, $imgsrc, $gender);
                if ($stmt->execute() == TRUE) {
                    echo "<main><h1 align='center'>Product Added!</h1></main>";
                    $insertProdSuccess = true;
                } else {
                    $error .= $conn->error;
                    $insertProdSuccess = false;
                }
            }
        }

        function deleteProduct() {
            global $dsuccess, $error;
            $delProdID = $_POST["product_select"];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $dsuccess = false;
            } else {
                $stmt = $conn->prepare("DELETE FROM p5_2.products WHERE product_id= ?");
                $stmt->bind_param("s", $delProdID);
                $stmt1 = $conn->prepare("DELETE FROM p5_2.product_details WHERE product_ID = ?");
                $stmt1->bind_param("s", $delProdID);
                $stmt2 = $conn->prepare("DELETE FROM p5_2.products_review WHERE product_ID = ?");
                $stmt2->bind_param("s", $delProdID);

                // Delete any details linked to product
                $stmt1->execute();
                // Delete any reviews linked to product
                $stmt2->execute();
                // Execute the delete from products
                if ($stmt->execute() == TRUE) {
                    // Alter auto_increment back to original number
                    $conn->query("ALTER TABLE p5_2.products AUTO_INCREMENT = $delProdID");
                    echo "<main><h1 align='center'>Product Deleted!</h1></main>";
                    $dsuccess = true;
                } else {
                    $error .= $conn->error;
                    echo "<main><h1 align='center'>$error</h1></main>";
                    $dsuccess = false;
                }
            }
        }

        function insertProductDetail() {
            global $insertDetSuccess, $error;
            $insProdDetID = $_POST["product_select"];
            $colour = $_POST["colour"];
            $size = $_POST["size"];
            $stock = $_POST["stock"];

            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $insertDetSuccess = false;
            } else {
                //INSERT INTO `p5_2`.`product_details` (`product_ID`, `colour`, `size`, `stock`) VALUES ('38', 'Black', 'US 10.5', '3');
                $stmt = $conn->prepare("INSERT INTO p5_2.product_details (product_ID, colour, size, stock) VALUES (?,?,?,?)");
                $stmt->bind_param("sssi", $insProdDetID, $colour, $size, $stock);
                if ($stmt->execute() == TRUE) {
                    echo "<main><h1 align='center'>Product Details Added!</h1></main>";
                    $insertDetSuccess = true;
                } else {
                    $error .= $conn->error;
//                    echo "<main><h1 align='center'>$error</h1></main>";
                    $insertDetSuccess = false;
                }
            }
        }

        if ($editChoice == "prod") {
            ?>
            <main>
                <div class="profilepage">
                    <div class="row align-items-center my-5">
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-12">
                            <h2 class="mb-4">ADMIN PAGE - INSERT / DELETE / UPDATE Products</h2>
                            <div id="updatebox">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?php echo htmlspecialchars('adminpage.php') ?>" onsubmit="return validateForm()"method="POST" name="insertForm">
                                                    <h3><b>Insert Product</b></h3>
                                                    <div class="row">
                                                        <label for="prodname" class="form-label-group">Product Name:</label>
                                                        <input class="form-control "type="text" name="prodname" id="prodname" pattern=".{1,255}" title="Contains only up to 255 characters" placeholder="Flyknit, etc" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="brand" class="form-label-group">Brand:</label>
                                                        <input class="form-control "type="text" name="brand" id="brand" pattern=".{1,45}" title="Contains only up to 45 characters" placeholder="Nike, Adidas, etc" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="desc" class="form-label-group">Description:</label>
                                                        <input class="form-control "type="text" name="desc" id="desc" pattern=".{1,255}" title="Contains only up to 255 characters" placeholder="Built for intense workouts with a tough ripstop material..." required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="type" class="form-label-group">Type:</label>
                                                        <input class="form-control "type="text" name="type" id="type" pattern=".{1,45}" title="Contains only up to 45 characters" placeholder="Running, Lifestyle, Training, etc" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="price" class="form-label-group">Unit Price:</label>
                                                        <input class="form-control" type="number" min="0" step=".01" name="price" id="price" placeholder="199.99" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="gender" class="form-label-group">Gender:</label>
                                                        <input class="form-control "type="text" name="gender" id="gender" pattern=".{1,45}" title="Contains only up to 45 characters" placeholder="Men/Women" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="image" class="form-label-group">Image Name:</label>
                                                        <input class="form-control "type="text" name="image" id="image" pattern=".{1,100}" title="Contains only up to 100 characters" placeholder="shoes.jpg/shoes.png" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="imgsrc" class="form-label-group">Image Source:</label>
                                                        <input class="form-control "type="text" name="imgsrc" id="imgsrc" pattern=".{1,255}" title="Contains only up to 255 characters" placeholder="www.adidas.com/image/running/shoes.png" required>
                                                        <!--https://www.adidas.com.sg/continental-80-shoes/EH0173.html-->
                                                    </div>
                                                    <div class="row">
                                                        <input type="hidden" name="prodid" value="1">
                                                        <button class="btn btn-outline-dark" type="submit">Insert</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?php echo htmlspecialchars('adminpage.php') ?> "method="POST" name="insForm">
                                                    <h3><b>Insert Product Details</b></h3>
                                                    <br/>
                                                    <label for="product_sel" class="form-label-group"><b>Choose a Product to Insert its Details into Database:</b></label>
                                                    <div class="row">

                                                        <select name="product_select" id="product_select" class="form-control">
                                                            <?php
                                                            getProductInfo();
                                                            for ($i = 0; $i < sizeof($pidArr); $i++) {
                                                                echo "<option value='$pidArr[$i]'" . ">" . $pidArr[$i] . " : " . $prodnameArr[$i] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <label for="colour">Colour: </label>
                                                        <input type="text" class="form-control" name="colour" pattern="[a-zA-Z]{1,50}" title="Contains only up to 50 characters" id="colour" placeholder="White/Black" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="size">Size: </label>
                                                        <input type="text" class="form-control" name="size" id="size" pattern=".{1,50}" title="Contains only up to 50 characters" placeholder="US 6.5" required>
                                                    </div>
                                                    <div class="row">
                                                        <label for="stock">Stock: </label>
                                                        <input type="number" class="form-control" name="stock" id="stock" pattern="[0-9]{1,50}" title="Contains only up to 50 numbers" placeholder="Qty" required>
                                                    </div>
                                                    <div class="row">
                                                        <input type="hidden" name="prodid" value="3">
                                                        <button class="btn btn-outline-dark" type="submit" name="insBtn" id="insBtn">Insert</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?php echo htmlspecialchars('adminpage.php') ?> "method="POST" name="upForm">
                                                    <h3><b>Update Product Details</b></h3>
                                                    <br/>
                                                    <label for="product_sel" class="form-label-group"><b>Choose a Product to Update its STOCK into Database:</b></label>
                                                    <div class="row">
                                                        <select name="product_select" id="product_select" class="form-control">
                                                            <?php
                                                            getProductDet();
                                                            for ($i = 0; $i < sizeof($pdidArr); $i++) {
                                                                echo "<option value='$pdidArr[$i]'" . ">" .
                                                                $pdidArr[$i] . " | " .
                                                                $uprodNameArr[$i] . " | Colour: " .
                                                                $ecolourArr[$i] . " | Size: " .
                                                                $esizeArr[$i] . " | Qty: " .
                                                                $estockArr[$i]
                                                                . "</option>";
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="row">
                                                        <label for="stock">Update Stock: </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="number" class="form-control" name="updatestock" id="updatestock" placeholder="Qty" required>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control" type="button" onclick="incrementValue(1)" value="+1">
                                                            <input class="form-control" type="button" onclick="incrementValue(-1)" value="-1">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control" type="button" onclick="incrementValue(10)" value="+10">
                                                            <input class="form-control" type="button" onclick="incrementValue(-10)" value="-10">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control" type="button" onclick="incrementValue(100)"value="+100">
                                                            <input class="form-control" type="button" onclick="incrementValue(-100)"value="-100">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <input type="hidden" name="prodid" value="4">
                                                        <button class="btn btn-outline-dark" type="submit" name="insBtn" id="upBtn">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?php echo htmlspecialchars('adminpage.php') ?> "method="POST" name="delform">
                                                    <h3><b>Delete Product</b></h3>
                                                    <br/>
                                                    <label for="product_sel" class="form-label-group"><b>Choose a Product to DELETE from Database:</b></label>
                                                    <div class="row">

                                                        <select name="product_select" id="product_select" class="form-control">
                                                            <?php
                                                            getProductInfo();
                                                            for ($i = 0; $i < sizeof($pidArr); $i++) {
                                                                echo "<option value='$pidArr[$i]'" . ">" . $pidArr[$i] . " : " . $prodnameArr[$i] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <input type="hidden" name="prodid" value="2">
                                                        <button class="btn btn-outline-dark" type="submit" name="delBtn" id="delBtn">Delete</button>
                                                    </div>
                                                </form>
                                                <br/><br/><br/><br/><hr>
                                                <div class="row">
                                                    <button style="position:absolute; right:0;" type="submit" onclick="window.history.back()" class="btn btn-outline-dark" id="editBtn">Back</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of update box-->
                        </div> <!-- Container for the box-->
                    </div>
                    <!-- /.col-md-4 -->
                </div>
            </main>
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <?php
        } else if ($editChoice == "memb") {
            ?>
            <main>
                <div class="profilepage">
                    <div class="row align-items-center my-5">
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-12">
                            <h2 class="mb-4">ADMIN PAGE - View Members</h2>
                            <div id="updatebox">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?php echo htmlspecialchars('adminorderhist.php') ?>" method="POST" name="Membform">  
                                                    <h3>Existing Members</h3>
                                                    <?php
                                                    getMembersInfo();
                                                    ?>
                                                    <div style="overflow-x: auto">
                                                        <table align="center" width="100%">
                                                            <tr>
                                                                <th>Member ID</th>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Email</th>
                                                                <th>Last Login</th>
                                                            </tr>
                                                            <?php
                                                            for ($i = 1; $i < sizeof($zidArr); $i++) {
                                                                echo "<tr>";
                                                                echo "<td>$zidArr[$i]</td>";
                                                                echo "<td>$fnameArr[$i]</td>";
                                                                echo "<td>$lnameArr[$i]</td>";
                                                                echo "<td>$emailArr[$i]</td>";
                                                                echo "<td>$lastloginArr[$i]</td>";
//                                                                echo "<td><input type='hidden' name='member_select' value='" . $zidArr[$i] . "'</td>";
//                                                                echo "<td><button type='submit' name='viewHistMembBtn'class='btn btn-outline-dark'>View</button></td>";
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </table>
                                                        <hr/><br/><br/>
                                                        <h2>View Order History</h2>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <select class="form-control" name="member_select">
                                                                    <?php
                                                                    for ($i = 1; $i < sizeof($zidArr); $i++) {
                                                                        echo "<option value='$zidArr[$i]'" . ">" . $zidArr[$i] . " : " . $fnameArr[$i] . " " . $lnameArr[$i] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <button type='submit' name='viewHistMembBtn'class='btn btn-outline-dark'>View</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                </form>
                                                <br/><br/><br/><br/><hr>
                                                <div class="row">
                                                    <button style="position:absolute; right:0;" type="submit" onclick="window.history.back()" class="btn btn-outline-dark">Back</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of updatebox-->
                        </div> <!-- Container for the whole box-->
                    </div>
                    <!-- /.col-md-4 -->
                </div>
            </main>
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <!-- **************************************************************************************************************************************************************************************-->
            <?php
        } else {
            ?>
            <main>
                <div class="profilepage">
                    <div class="row align-items-center my-5">
                        <div class="col-lg-12">
                            <h2 class="mb-4">ADMIN PAGE</h2>
                            <div class="container">
                                <div class="card-deck">
                                    <div class="card">
                                        <a style="color:black;" href="profile.php">
                                            <img class="card-img-top" src="img/profile.jpg" alt="View or Change Profile Settings">
                                            <!-- SOURCE: https://www.kissclipart.com/user-edit-icon-clipart-computer-icons-user-profile-v1ctia/ -->
                                            <div class="card-body">
                                                <h5 class="card-title">Profile Settings</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card">
                                        <a style="color:black;" href="changePW.php">
                                            <img class="card-img-top" src="img/password-image.jpg" alt="Change Password">
                                            <!-- SOURCE: https://www.kissclipart.com/password-clipart-password-policy-computer-security-zk32t8/ -->
                                            <div class="card-body">
                                                <h5 class="card-title">Change Password</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card">
                                        <a style="color:black;" href="adminpage.php?edit=prod">
                                            <img class="card-img-top" src="img/editproduct.png" alt="Edit Product">
                                            <!-- SOURCE: https://www.kissclipart.com/menu-clipart-menu-hamburger-button-computer-icons-evm9g3/ -->
                                            <div class="card-body">
                                                <h5 class="card-title">Edit Products</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card">
                                        <a style="color:black;" href="adminpage.php?edit=memb">
                                            <img class="card-img-top" src="img/editmember.png" alt="Edit Members">
                                            <!-- SOURCE: https://www.kissclipart.com/password-clipart-password-policy-computer-security-zk32t8/ -->
                                            <div class="card-body">
                                                <h5 class="card-title">View Members</h5>
                                                <!--<p class="card-text"></p>-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> <!-- /.container --> 
                        </div> <!-- Container for the whole of container--> <?php } ?>
                </div>
                <!-- /.col-md-4 -->
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
