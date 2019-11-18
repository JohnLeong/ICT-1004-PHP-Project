<?php
include "header.php";
if (!isset($_SESSION['name'])) {
    echo "<script>window.location.href='index.php'</script>";
}
?>

<?php

$first_name = $last_name = $email = $gender = $mobile = $country = $city = $address = "";
$dob_d = $dob_m = $dob_y = "";
$dob = "";
$errorMsg = "";

$cart = 0;

// Check if its for Shopping Cart or for General Profile edits
if (!isset($_POST['cart'])) {
    $cart = 0;
    updateMemberInfoPrep();
} else {
    $cart = $_POST['cart'];
}

if ($cart == 1) {
    $id = $_SESSION['zid'];
    // Create connection
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $cemail = $_POST['cemail'];
        $cmobile = $_POST['cmobile'];
        $caddress = $_POST['caddress'];

        // prepare and bind
        $stmt = $conn->prepare("UPDATE p5_2.zenith_members SET email=?,mobile=?,address=? WHERE zmember_id=?");
        $stmt->bind_param("ssss", $cemail, $cmobile, $caddress, $id);

        if ($stmt->execute() == true) {
            ?>
            <script> location.replace("../shoppingcart.php?success");</script>
            <?php

        } else {
            $error .= $conn->error;
            $success = false;
        }
    }
}

function getMemberInfo() {
    global $first_name, $last_name, $email, $gender, $mobile, $country, $city, $address;
    global $dob, $dob_d, $dob_m, $dob_y;

    //first name
    $error = "";
    $first_name = $errorMsg = "";
    if (empty($_POST["first_name"])) {
        $errorMsg .= "First name is required.<br>";
        $success = false;
    } else {
        $first_name = sanitize_input($_POST["first_name"]);
    }
    $error .= $errorMsg;

    //last name
    $last_name = $errorMsg = "";
    if (empty($_POST["last_name"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $last_name = sanitize_input($_POST["last_name"]);
    }
    $error .= $errorMsg;
    global $success;
    //email
    $email = $errorMsg = "";
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }

    //mobile
    $mobile = $errorMsg = "";
    if (empty($_POST["mobile"])) {
        $errorMsg .= "Mobile is required.<br>";
        $success = false;
    } else {
        $mobile = sanitize_input($_POST["mobile"]);
    }

    //country
    $country = $errorMsg = "";
    if (empty($_POST["country"])) {
        $errorMsg .= "Country is required.<br>";
        $success = false;
    } else {
        $country = sanitize_input($_POST["country"]);
    }

    //city
    $city = $errorMsg = "";
    if (empty($_POST["city"])) {
        $errorMsg .= "City is required.<br>";
        $success = false;
    } else {
        $city = sanitize_input($_POST["city"]);
    }
    //dob
    $dob = $errorMsg = "";
    $dob_d = $_POST["dob_d"];
    $dob_m = $_POST["dob_m"];
    $dob_y = $_POST["dob_y"];
    // Date format YYYY-MM-DD
    $dob .= $dob_y . "-";
    $dob .= $dob_m . "-";
    $dob .= $dob_d;

    //gender
    $gender = $errorMsg = "";
    if (empty($_POST["gender"])) {
        $errorMsg .= "Gender is required.<br>";
        $success = false;
    } else {
        $gender = sanitize_input($_POST["gender"]);
    }
    //address
    $address = $errorMsg = "";
    if (empty($_POST["address"])) {
        $errorMsg .= "Address is required.<br>";
        $success = false;
    } else {
        $address = sanitize_input($_POST["address"]);
    }
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function updateMemberInfoPrep() {
    global $id, $email, $first_name, $last_name, $dob;
    global $gender, $mobile, $country, $city, $address, $success, $zid;
    global $day, $month, $year, $error;
    getMemberInfo();
    $id = $_SESSION['zid'];
    // Create connection
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // prepare and bind
        $stmt = $conn->prepare("UPDATE p5_2.zenith_members SET fname= ?, lname=?, email=?, dob=?, gender=?, mobile=?, country=?, city=?, address=? WHERE zmember_id=?");
        $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $dob, $gender, $mobile, $country, $city, $address, $id);

        if ($stmt->execute() == true) {
            header("Location: ../profile.php?UpdateSuccess");
        } else {
            $error .= $conn->error;
            header("Location: ../profile.php?UpdateFailed");
        }
    }
    $conn->close();
}
?>

