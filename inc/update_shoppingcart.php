<?php

if ((!isset($_POST['addtocart'])) && (!isset($_POST['updatecartqty'])) && (!isset($_POST['deleteitem'])) && (!isset($_POST['updatepromo']))) {
    header('Location: ../index.php');
} else {
    include_once("session.php");
    $id = $_SESSION['zid'];
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        if (isset($_POST['updatepromo'])) {
            $code = $_POST['usercode'];
            $sql = "SELECT * FROM p5_2.zpromo_code WHERE zmember_id='$id' && promocode='$code'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $main = substr($code, 0, 3);
                if ($main == "z25") {
                   header('Location: ../shoppingcart.php?25');
                }
            } else {
                header('Location: ../shoppingcart.php?failure');
            }
        }
        else if (isset($_POST['updatecartqty'])) {
            $quantity = $_POST['qty'];
            $prodDID = $_POST['prodDID'];
            if ($quantity == 0) {
                $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
                // Execute the query
                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
                    $success = false;
                }
                header('Location: ../shoppingcart.php');
            } else {
                $sql = "SELECT * FROM p5_2.product_details WHERE productDetail_id='$prodDID'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $stock = $row["stock"];
                    
                    if (($stock - $quantity) < 0) {
                        $url = $_SERVER['HTTP_REFERER'] . "" . "?nostock";
                        header('Location: ' . $url);
                    } else {
                        $sql = "UPDATE p5_2.zshoppingcart SET quantity='$quantity' WHERE productDetail_ID='$prodDID'";
                        // Execute the query
                        if (!$conn->query($sql)) {
                            $errorMsg = "Database error: " . $conn->error;
                            $success = false;
                        }
                        header('Location: ../shoppingcart.php');
                    }
                }
            }
        } else if (isset($_POST['deleteitem'])) {
           $prodDID = $_POST['prodDID'];
            $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
            // Execute the query
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            header('Location: ../shoppingcart.php');
        }
        else {
            $coloursize = $_POST['shoe_select'];
            $split = explode(':', $coloursize, 4);
            $pid = $split[0];
            $colour = $split[1];
            $size = $split[2];
            $stock = $split[3];
            $pname = $_POST['productname'];
            $price = $_POST['price'];
            $image = $_POST['img'];

            $check = "SELECT * FROM p5_2.zshoppingcart WHERE productDetail_ID=$pid";
            $dupcheck = mysqli_query($conn, $check);
            // to check if user have already added this product to cart, if added then quanity + 1
            if ($dupcheck->num_rows > 0) {
                $data = $dupcheck->fetch_assoc();
                $update = $data["quantity"] + 1;
                if ((($stock - $update) < 0 )) {
                    $url = $_SERVER['HTTP_REFERER'] . "" . "&nostock";
                    header('Location: ' . $url);
                } else {
                    $sql = "UPDATE p5_2.zshoppingcart SET quantity='$update' WHERE productDetail_ID='$pid' && zmember_id='$id'";
                    // Execute the query
                    if (!$conn->query($sql)) {
                        $errorMsg = "Database error: " . $conn->error;
                        $success = false;
                    }
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                if (($stock - $data["quantity"]) < 0 ) {
                    $url = $_SERVER['HTTP_REFERER'] . "" . "&nostock";
                    header('Location: ' . $url);
                } else {
                    $sql = "INSERT INTO p5_2.zshoppingcart (productDetail_ID, zmember_id, product_name, unit_price, colour, size, image, quantity)"
                            . " VALUES ('$pid', '$id','$pname','$price','$colour','$size', '$image', '1')";
                    // Execute the query
                    if (!$conn->query($sql)) {
                        $errorMsg = "Database error: " . $conn->error;
                        $success = false;
                    }
                } header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
} $conn->close();
    
    
    
    
//    if (isset($_POST['updatecartqty'])) {
//    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
//    // Check connection
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        $success = false;
//    } else {
//        $quantity = $_POST['qty'];
//        $prodDID = $_POST['prodDID'];
//        if ($quantity == 0) {
//            $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
//        } else {
//            $sql = "UPDATE p5_2.zshoppingcart SET quantity='$quantity' WHERE productDetail_ID='$prodDID'";
//        }
//        // Execute the query
//        if (!$conn->query($sql)) {
//            $errorMsg = "Database error: " . $conn->error;
//            $success = false;
//        }
//        header('Location: ../shoppingcart.php');
//    }
//} else if (isset($_POST['deleteitem'])) {
//    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
//    // Check connection
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        $success = false;
//    } else {
//        $prodDID = $_POST['prodDID'];
//        $sql = "DELETE FROM p5_2.zshoppingcart WHERE productDetail_ID='$prodDID'";
//        // Execute the query
//        if (!$conn->query($sql)) {
//            $errorMsg = "Database error: " . $conn->error;
//            $success = false;
//        }
//        header('Location: ../shoppingcart.php');
//    }
//} else {
//    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
//    // Check connection
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        $success = false;
//    } else {
//        include_once("session.php");
//        $id = $_SESSION['zid'];
//        $coloursize = $_POST['shoe_select'];
//        $split = explode(':', $coloursize, 3);
//        $pid = $split[0];
//        $colour = $split[1];
//        $size = $split[2];
//        $pname = $_POST['productname'];
//        $price = $_POST['price'];
//        $image = $_POST['img'];
//        
//        $check = "SELECT * FROM p5_2.zshoppingcart WHERE productDetail_ID=$pid";
//        $dupcheck = mysqli_query($conn, $check);
//        // to check if user have already added this product to cart, if added then quanity + 1
//        if ($dupcheck->num_rows > 0) {
//            $data = $dupcheck->fetch_assoc();
//            $update = $data["quantity"] + 1;
//            $sql = "UPDATE p5_2.zshoppingcart SET quantity='$update' WHERE productDetail_ID='$pid' && zmember_id='$id'";
//            // Execute the query
//            if (!$conn->query($sql)) {
//                $errorMsg = "Database error: " . $conn->error;
//                $success = false;
//            }
//        } else {
//            $sql = "INSERT INTO p5_2.zshoppingcart (productDetail_ID, zmember_id, product_name, unit_price, colour, size, image, quantity)"
//                    . " VALUES ('$pid', '$id','$pname','$price','$colour','$size', '$image', '1')";
//            // Execute the query
//            if (!$conn->query($sql)) {
//                $errorMsg = "Database error: " . $conn->error;
//                $success = false;
//            }
//        }
//        header('Location: ' . $_SERVER['HTTP_REFERER']);
//    }
//}
?>