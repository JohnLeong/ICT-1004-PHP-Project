<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "header.php";

$pid = $_POST['prodID'];


if (!isset($_SESSION['zid'])) {
    $zid = 1;
} else {
    $zid = $_SESSION['zid'];
}
//        if (isset($_SESSION['name'])) {
//            header('Location: product_detail.php?productID=' . $pid);
//        }
?>
<?php

//Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p5_2");
define("DBUSER", "p5_2");
define("DBPASS", "yzhbGyqP87");
global $success;

//Review
$error = "";
$reviews = $errorMsg = "";
$success = true;

if (empty($_POST["reviewbox"])) {
    $errorMsg .= "Review  is required.<br>";
    $success = false;
} else if (preg_match("/^.{1,500}$/", $_POST["reviewbox"]) == false) {
    $errorMsg .= "Review box can only fit 500 characters";
    $success = false;
} else {
    $reviews = sanitize_input($_POST["reviewbox"]);
}
$error .= $errorMsg;
if ($success == true) {
    insertNewReviews();
}else {
    header("Location: ../product_detail.php?productID=$pid" . "?RFailed");
}

function insertNewReviews() {
    global $zid, $pid, $success, $errorMsg, $date, $reviews, $numOfReviews;
    $date = date('Y-m-d H:i:s');
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);


    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {

        // SQL Statement
        $stmt = $conn->prepare("INSERT INTO p5_2.products_review (product_ID, zmember_id, reviews, datetime) VALUES (?,?,?,?)");
        $stmt->bind_param("iiss", $pid, $zid, $reviews, $date);

        $result = $stmt->get_result();


        // Execute the query
        if ($stmt->execute() == true) {
            $success = true;
            header("Location: ../product_detail.php?productID=$pid" . "?RSuccess");
        } else {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
            header("Location: ../product_detail.php?productID=$pid" . "?RFailed");
        }
        $conn->close();
    }
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
