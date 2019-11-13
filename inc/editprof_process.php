<?php

include 'header.php';
if (!isset($_SESSION['name'])) {
//            header('Location: index.php');
    echo "<script>window.location.href='index.php'</script>";
}
?>

<?php

$first_name = $last_name = $email = $gender = $mobile = $country = $city = $address = "";
$dob_d = $dob_m = $dob_y = "";
$dob = "";
$errorMsg = "";
$success = true;

$cart = 0;

// Check if its for Shopping Cart or for General Profile edits
if (!isset($_POST['cart'])) {
    $cart = 0;
    updateMemberInfo();
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
        $sql = "UPDATE p5_2.zenith_members SET";
        $sql .= " email = '" . $cemail . "',";
        $sql .= " mobile = '" . $cmobile . "',";
        $sql .= " address = '" . $caddress . "'";
        $sql .= " WHERE zmember_id='" . $id . "'";
        if ($conn->query($sql) == TRUE) {
            ?>
            <script> location.replace("checkout.php?success");</script>
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

function updateMemberInfo() {
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
        $sql = "UPDATE p5_2.zenith_members SET";
        $sql .= " fname = '" . $first_name . "',";
        $sql .= " lname = '" . $last_name . "',";
        $sql .= " email = '" . $email . "',";
        $sql .= " dob = '" . $dob . "',";
        $sql .= " gender = '" . $gender . "',";
        $sql .= " mobile = '" . $mobile . "',";
        $sql .= " country = '" . $country . "',";
        $sql .= " city = '" . $city . "',";
        $sql .= " address = '" . $address . "'";
        $sql .= " WHERE zmember_id='" . $id . "'";
        // Execute the query
        if ($conn->query($sql) == TRUE) {
            $success = true;
            header("Location: ../profile.php?UpdateSuccess");
        } else {
            $error .= $conn->error;
            header("Location: ../profile.php?UpdateFailed");
        }
    }
}

$conn->close();
?>

