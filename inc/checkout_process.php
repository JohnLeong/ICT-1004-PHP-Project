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
        
        $sql = "INSERT INTO p5_2.zorders SELECT * FROM p5_2.zshoppingcart WHERE zmember_id =$id";
        // Execute the query
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
//        $sql = "SELECT * FROM p5_2.zshoppingcart WHERE zmember_id =$id";
//        $result = mysqli_query($conn, $sql);
//        if ($result->num_rows > 0){
//            $data = $result->fetch_assoc();
//            $pname = $data["product_name"];
//            $price = $data["unit_price"];
//            $colour = $data["colour"];
//            $size = $data["size"];
//            $image = $data["image"];
//            $qty = $data["quantity"];
//        }
//        $i = 0;
//        while ($i < $result){
//            $osql = "INSERT INTO p5_2.zorders (zmember_id, product_name, unit_price, colour, size, image, quantity, date)"
//                . " VALUES ('$id','$pname','$price','$colour','$size', '$image', '$qty', '$date')";
//        // Execute the query
//            if (!$conn->query($osql)) {
//                $errorMsg = "Database error: " . $conn->error;
//                $success = false;
//            }
//            $i += 1;
//        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }  
} $conn->close();