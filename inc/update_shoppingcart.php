<?php

if (!isset($_POST['addtocart'])) {
    header('Location: ../index.php');
} else {
    // Create connection
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
        $pid = $_POST['productID'];
        $pname = $_POST['productname'];
        $price = $_POST['price'];
                
        $sql = "INSERT INTO p5_2.shoppingcart (zmember_id, product_ID, product_name, unit_price, colour, size)"
                . "VALUES ('$id','$pid','$pname','$price','$colour','$size)";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
        
        //header("location:javascript://history.go(-1)");
    }
}
?>