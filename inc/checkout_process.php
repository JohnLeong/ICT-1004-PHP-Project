<?php

if (!isset($_POST['paynow'])) {
    header('Location: ../index.php');
} else {
    global $pname, $price, $colour, $size, $image, $qty;

    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        include_once("session.php");
        $id = $_SESSION['zid'];
        date_default_timezone_set('Asia/Singapore');
        $date = date("M,d,Y h:i:s A");
        $disc = $_POST["discount"];
        $shipfee = $_POST["shippingfee"];
        $finalp = $_POST["final"];

        $status = "In Transit";

        //shopping cart items
        $psql = "SELECT * FROM p5_2.zshoppingcart WHERE zmember_id = $id";
        $presult = mysqli_query($conn, $psql);
        $proid = array();
        
        $sql = "INSERT INTO p5_2.zorder (zmember_id, date, total_amt, discount, shipping_fee, status)"
                . " VALUES ('$id','$date','$finalp','$disc','$shipfee', '$status')";
        // Execute the query
        if (!$conn->query($sql) == TRUE) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        
        while ($prow = mysqli_fetch_assoc($presult)) {
            array_push($proid, $prow['productDetail_ID']);
        }

        //store length of array
        $size_proid = sizeof($proid);
        $loop = 0;

        $lastsql = "SELECT order_id FROM p5_2.order_details ORDER BY order_id DESC LIMIT 1";
        $lastresult = mysqli_query($conn, $lastsql);
        $lastrow = mysqli_fetch_assoc($lastresult);
        $lastid = $lastrow['order_id'];

        if (empty($lastid)) {
            $oid = 1;
        } else {
            $oid = $lastid + 1;
        }

        while ($loop < $size_proid) {
            $iodsql = "INSERT INTO p5_2.order_details (order_id, productDetail_ID)"
                    . " VALUES ('$oid', '$proid[$loop]')";
            // Execute the query
            if (!$conn->query($iodsql) == TRUE) {

                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }

            $uodsql = "UPDATE p5_2.order_details "
                    . "SET size = (Select size from p5_2.zshoppingcart where productDetail_ID = $proid[$loop]),"
                    . "product_name = (Select product_name from p5_2.zshoppingcart where productDetail_ID = $proid[$loop]),"
                    . "colour = (Select colour from p5_2.zshoppingcart where productDetail_ID = $proid[$loop]),"
                    . "image = (Select image from p5_2.zshoppingcart where productDetail_ID = $proid[$loop]),"
                    . "quantity = (Select quantity from p5_2.zshoppingcart where productDetail_ID = $proid[$loop])"
                    . "WHERE productDetail_ID=$proid[$loop] AND order_id = $oid";

            if (!$conn->query($uodsql)) {

                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $loop += 1;
        }
        
        //deducting the stock based on customer purchase
        
        $stockqty = array();
        $ploop = 0;
        //taking the stock from product detail using ProductDetail_ID
        while ($ploop < $size_proid) {
            $tssql = "SELECT * FROM p5_2.product_details WHERE productDetail_ID = $proid[$ploop] ORDER BY productDetail_ID ASC";
            $tsresult = mysqli_query($conn, $tssql);
            $tsrow = mysqli_fetch_assoc($tsresult);
            array_push($stockqty, $tsrow['stock']);
            $ploop += 1;
        }
        
        //taking the quantity that the user bought from shopping cart using zmember_id
        $uqsql = "SELECT * FROM p5_2.zshoppingcart WHERE zmember_id ='$id' ORDER BY productDetail_ID ASC";
        $uqresult = mysqli_query($conn, $uqsql);
        $userqty = array();
        
        while ($uqrow = mysqli_fetch_assoc($uqresult)) {
            array_push($userqty, $uqrow['quantity']);
        }
        
        $usloop = 0;
        // while loop to deduct the stock, by taking stock - userqty using productDetail_ID
        while ($usloop < $size_proid) {
            $dssql = "UPDATE p5_2.product_details "
                    . "SET stock = ($stockqty[$usloop] - $userqty[$usloop])"
                    . "WHERE productDetail_ID=$proid[$usloop]";
            if (!$conn->query($dssql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $usloop += 1;
        }
        
        // Delete products from shopping cart
        $dsql = "DELETE FROM p5_2.zshoppingcart WHERE zmember_id='$id'";
        // Execute the query
        if (!$conn->query($dsql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        
        // Remove Promo Code if used.
        if($disc != 0) {
            $removesql = "DELETE FROM p5_2.zpromo_code WHERE zmember_id=$id";
            // Execute the query
            if (!$conn->query($dsql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    } 
} $conn->close();
header("Location: ../orderconfirmed.php?success");


