<?php

if ((!isset($_POST['addtocart'])) && (!isset($_POST['updatecartqty'])) && (!isset($_POST['deleteitem']))) {
    header('Location: ../index.php');
} else if (isset($_POST['updatecartqty'])) {
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $quantity = $_POST['qty'];
        $prodDID = $_POST['prodDID'];
        if ($quantity == 0) {
            $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
        } else {
            $sql = "UPDATE p5_2.zshoppingcart SET quantity='$quantity' WHERE productDetail_ID='$prodDID'";
        }
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        header('Location: ../shoppingcart.php');
    }
} else if (isset($_POST['deleteitem'])) {
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $prodDID = $_POST['prodDID'];
        $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        header('Location: ../shoppingcart.php');
    }
} else {
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        include_once("session.php");
        $id = $_SESSION['zid'];
        $coloursize = $_POST['shoe_select'];
        $split = explode(':', $coloursize, 2);
        $colour = $split[0];
        $size = $split[1];
        $pdid = $_POST['productDetailID'];
        $pname = $_POST['productname'];
        $price = $_POST['price'];
        $image = $_POST['img'];

        $sql = "INSERT INTO p5_2.zshoppingcart (productDetail_ID, zmember_id, product_name, unit_price, colour, size, image, quantity)"
                . " VALUES ('$pdid', '$id','$pname','$price','$colour','$size', '$image', '1')";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>