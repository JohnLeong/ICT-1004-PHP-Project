<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Profile Process</title>
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

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        include 'inc/header.php';
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

        // Troubleshoot
//            echo "<script type='text/javascript'>alert('$dob');</script>";
//            echo "<script type='text/javascript'>alert('$gender');</script>";
//            echo "<script type='text/javascript'>alert('$first_name');</script>";
//            echo "<script type='text/javascript'>alert('$last_name');</script>";
//            echo "<script type='text/javascript'>alert('$mobile');</script>";
//            echo "<script type='text/javascript'>alert('$city');</script>";
//            echo "<script type='text/javascript'>alert('$country');</script>";
        $register = 'register.php';
        $home = 'index.php';
        $cart = 0;
        
        if (!isset($_POST['cart'])) {
            $cart = 0;
        } else {
            $cart = $_POST['cart'];
        }   
        // Check if its for Shopping Cart or for General Profile edits

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
                    $success = true;
                } else {
                    $error .= $conn->error;
                    $success = false;
                }
            }
            
            if ($success) {
                header('Location: checkout.php');
            }else{
             echo "<script type='text/javascript'>alert('Update failed!');</script>";   
            }
            
        } else {
            updateMemberInfo();
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
                } else {
                    $error .= $conn->error;
                    $success = false;
                }
            }
        }

        $conn->close();
        ?>
        <main>
            <div class ="container-fluid register">
                <form method="post">
                    <div class="form-group">
                        <?php
                        if ($success == 1) {
                            echo "<h2>Your Profile has been updated. </h2>";
                            ?> 
                            <input class="btn btn-default" type="button" value="Return to Shopping" 
                                   onclick="window.location.href = 'index.php'" />
                                   <?php
                               } else {
                                   echo "<h2>Opps! Error Found!</h2>";
                                   echo $error;
                                   ?>
                            <input class="btn btn-outline-dark" type="button" value="Return to Edit Profile" 
                                   onclick="window.location.href = 'editprofile.php'" />
                               <?php } ?>
                    </div>
                </form>
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
