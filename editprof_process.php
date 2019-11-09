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
        
        //address
        $address = $errorMsg = "";
        if (empty($_POST["address"])) {
            $errorMsg .= "Address is required.<br>";
            $success = false;
        } else {
            $address = sanitize_input($_POST["address"]);
        }
        
        // Troubleshoot
        echo "<script type='text/javascript'>alert('$address');</script>";
        echo "<script type='text/javascript'>alert('$gender');</script>";
        echo "<script type='text/javascript'>alert('$first_name');</script>";
        echo "<script type='text/javascript'>alert('$last_name');</script>";
        echo "<script type='text/javascript'>alert('$mobile');</script>";
        echo "<script type='text/javascript'>alert('$city');</script>";
        echo "<script type='text/javascript'>alert('$country');</script>";
        
        
        
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
            global $day, $month, $year;

            $id = $_SESSION['zid'];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $sql = "UPDATE p5_2.zenith_members SET";
                // UPDATE `p5_2`.`zenith_members` SET `fname` = 'XB', `lname` = 'Po',
                //  `email` = 'xb@hotmaill.com', `dob` = '1997-07-11', `gender` = 'MALE',
                //   `mobile` = '12342312',
                //  `country` = 'SG', `city` = 'SG', `address` = '828 Woodlands Drive 50 #01-123' 
                //  WHERE (`zmember_id` = '2');
                // Insert update statement
                $sql .= "WHERE zmember_id='$id'";

                // Execute the query
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_name = $row["fname"];
                    $last_name = $row["lname"];
                    $email = $row["email"];
                    $gender = $row["gender"];
                    $mobile = $row["mobile"];
                    $country = $row["country"];
                    $city = $row["city"];
                    $address = $row["address"];

                    $dob = $row["dob"];
                    $dob = strtotime($dob); // String to time
                    $day = date('d', $dob);
                    $month = date('m', $dob);
                    $year = date('Y', $dob);
                } else {
                    $success = false;
                }
                $result->free_result();
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
                            echo "<h2>Your registration is successful!</h2>";
                            echo "<h4>Thanks for signing up " . $first_name . ".</h4>";
                            saveMemberToDB($first_name, $last_name, $email, $password);
                            ?>
                            <input class="btn btn-default" type="button" value="Login Now" 
                                   onclick="window.location.href = 'login.php'" />
                            <input class="btn btn-default" type="button" value="Home" 
                                   onclick="window.location.href = 'index.php'" />

                            <?php
                        } else {
                            echo "<h2>Oops!</h2>";
                            echo "<h4>The following input errors were detected:</h4>";
                            echo $error;
                            ?>
                            <input class="btn btn-default" type="button" value="Return to Sign up" 
                                   onclick="window.location.href = 'register.php'" />
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
