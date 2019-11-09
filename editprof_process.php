<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Register</title>
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
            header('Location: index.php');
        }
        ?>

        <?php
        $first_name = $last_name = $email = $gender = $mobile = $country = $city = $address = "";
        $dob_d = $dob_m = $dob_y = "";
        $errorMsg = "";
        $success = true;

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

        //gender
        $gender = $errorMsg = "";
        if (empty($_POST["gender"])) {
            $errorMsg .= "Gender is required.<br>";
            $success = false;
        } else {
            $gender = sanitize_input($_POST["gender"]);
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
            
            
        //address
        $address = $errorMsg = "";
        if (empty($_POST["address"])) {
            $errorMsg .= "Address is required.<br>";
            $success = false;
        } else {
            $address = sanitize_input($_POST["address"]);
        }


        // Troubleshoot
//        echo "<script type='text/javascript'>alert('$dob');</script>";
//        echo "<script type='text/javascript'>alert('$gender');</script>";
//        echo "<script type='text/javascript'>alert('$first_name');</script>";
//        echo "<script type='text/javascript'>alert('$last_name');</script>";
//        echo "<script type='text/javascript'>alert('$mobile');</script>";
//        echo "<script type='text/javascript'>alert('$city');</script>";
//        echo "<script type='text/javascript'>alert('$country');</script>";

        updateMemberInfo();

        $register = 'register.php';
        $home = 'index.php';

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

            $id = $_SESSION['zid'];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
//                 UPDATE `p5_2`.`zenith_members` SET `fname` = 'XB', `lname` = 'Po',
//                  `email` = 'xb@hotmaill.com', `dob` = '1997-07-11', `gender` = 'MALE',
//                   `mobile` = '12342312',
//                  `country` = 'SG', `city` = 'SG', `address` = '828 Woodlands Drive 50 #01-123' 
//                  WHERE (`zmember_id` = '2');
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
            $conn->close();
        }
        ?>
        <main>
            <div class ="container-fluid register">
                <form method="post">
                    <div class="form-group">
                        <?php
                        if ($success) {
//                            echo "<script type='text/javascript'>alert('Your info has been updated :) Thank you!');</script>";
                            echo "<h2>Your Profile has been updated. </h2>";
                            ?> 
                            <input class="btn btn-default" type="button" value="Return to Shopping" 
                                   onclick="window.location.href = 'index.php'" />
                            <?php
                        } else {
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
