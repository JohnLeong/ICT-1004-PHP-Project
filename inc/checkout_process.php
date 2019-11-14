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
            $iodsql = "INSERT INTO p5_2.order_details (order_id, product_id)"
                    . " VALUES ('$oid', '$proid[$loop]')";
            // Execute the query
            if (!$conn->query($iodsql) == TRUE) {

                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }

            $uodsql = "UPDATE p5_2.order_details "
                    . "SET product_name = (Select product_name from p5_2.zshoppingcart where productDetail_ID = $proid[$loop])"
                    . "WHERE product_id=$proid[$loop] AND order_id = $oid";

            if (!$conn->query($uodsql)) {

                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $ucsodsql = "UPDATE p5_2.order_details "
                    . "SET colour = (Select colour from p5_2.zshoppingcart where productDetail_ID = $proid[$loop] and zmember_id = $id),"
                    . "size = (Select size from p5_2.zshoppingcart where productDetail_ID = $proid[$loop] and zmember_id = $id),"
                    . "image = (Select image from p5_2.zshoppingcart where productDetail_ID = $proid[$loop] and zmember_id = $id),"
                    . "quantity = (Select quantity from p5_2.zshoppingcart where productDetail_ID = $proid[$loop] and zmember_id = $id)"
                    . "WHERE product_id=$proid[$loop] AND order_id = $oid";

            if (!$conn->query($ucsodsql)) {

                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $loop += 1;
        }
        // Delete products from shopping cart
        $dsql = "DELETE FROM p5_2.zshoppingcart WHERE zmember_id='$id'";
        // Execute the query
        if (!$conn->query($dsql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
    } 
} $conn->close();
header("Location: ../orderconfirmed.php?success");


