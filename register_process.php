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
        ?>
        
        <?php
        // Constants for accessing our DB:
        define("DBHOST", "localhost");
        define("DBNAME", "zenith");
        define("DBUSER", "root");
        define("DBPASS", "");
        $fname = $lname = $email = $password = "";
        $errorMsg = "";
        $success = true;

        //first name
        $error="";
        $first_name = $errorMsg = "";
        $success = true;
        if (empty($_POST["first_name"])) {
            $errorMsg .= "First name is required.<br>";
            $success = false;
        } else {
            $first_name = sanitize_input($_POST["first_name"]);
        }   
        $error.=$errorMsg;

        //last name
        $last_name = $errorMsg = "";
        $success = true;
        if (empty($_POST["last_name"])) {
            $errorMsg .= "Last name is required.<br>";
            $success = false;
        } else {
            $last_name = sanitize_input($_POST["last_name"]);
        }    
        $error.=$errorMsg;

        //email
        $email = $errorMsg = "";
        $success = true;
        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = sanitize_input($_POST["email"]);
            // Additional check to make sure e-mail address is well-formed.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
                $success = false;
            }
        }
        $error.=$errorMsg;

        //password
        $password = $errorMsg = "";
        $success = true;
        if (empty($_POST["password"])) {
            $errorMsg .= "Password is required.<br>";
            $success = false;
        } else {
            $password = sanitize_input($_POST["password"]);
        }
        $error.=$errorMsg;    

        //confirm password
        $confirm_password = $errorMsg = "";
        $success = true;
        if (empty($_POST["confirm_password"])) {
            $errorMsg .= "Confirm password is required.<br>";
            $success = false;
        } 
        else if ($_POST["password"]!=$_POST["confirm_password"]){
            $errorMsg .= "Password does not match confirm password.<br>";
            $success = false;
        }
        else {
            $confirm_password = sanitize_input($_POST["confirm_password"]);
        }
        $error.=$errorMsg;
        $register='register.php';
        $home = 'index.php';

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        /* Helper function to write the data to the DB */
        function saveMemberToDB() {
            global $first_name, $last_name, $email, $password, $errorMsg, $success;
            // Create connection
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            }
            else {
                $sql = "INSERT INTO zenith_members (fname, lname, email, password)";
                $sql .= " VALUES ('$first_name', '$last_name', '$email', '$password')";
                // Execute the query
                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
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
                        saveMemberToDB($first_name, $last_name, $email, $password);
                        if ($success) {
                            echo "<h2>Your registration is successful!</h2>";
                            echo "<h4>Thanks for signing up " . $first_name . ".</h4>";
                            
                            ?>
                            <input class="btn btn-default" type="button" value="Login Now" 
                                   onclick="window.location.href='login.php'" />
                            <input class="btn btn-default" type="button" value="Home" 
                                   onclick="window.location.href='index.php'" />

                        <?php
                        } else {
                            echo "<h2>Oops!</h2>";
                            echo "<h4>The following input errors were detected:</h4>";
                            echo $error;
                            ?>
                            <input class="btn btn-default" type="button" value="Return to Sign up" 
                                   onclick="window.location.href='register.php'" />
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
