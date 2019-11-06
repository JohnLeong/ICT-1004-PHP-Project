<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--BootStrap 4 CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!--Website Main CSS-->
        <link rel="stylesheet" href="../css/zenithMainStyle.css" />

        <!--Favicon for browser tab-->
        <link rel="shortcut icon" href="../img/zshoe-icon.png"/>

        <!--Icons for Web-->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        include 'header.php';
        if(!isset($_POST['login_submit'])){
            header('Location: ../index.php');
        }
        ?>

        <?php
        //Constants for accessing our DB:
        define("DBHOST", "localhost");
        define("DBNAME", "zenith");
        define("DBUSER", "root");
        define("DBPASS", "");
        $fname = $lname = $email = $password = "";
        $errorMsg = "";
        $success = true;

        $error = "";
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
        $error .= $errorMsg;

        //password
        $password = $errorMsg = "";
        $success = true;
        if (empty($_POST["password"])) {
            $errorMsg .= "Password is required.<br>";
            $success = false;
        } else {
            $password = sanitize_input($_POST["password"]);
        }
        $error .= $errorMsg;

        $register = 'register.php';
        $home = 'index.php';


        // Functions
        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function checkMemberDb() {
            global $email, $first_name, $last_name, $password, $success;
            // Create connection
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $sql = "SELECT * FROM zenith_member WHERE ";
                $sql .= "email='$email' AND password='$password'";
                // Execute the query
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Note that email field is unique, so should only have
                    // one row in the result set.
                    $row = $result->fetch_assoc();
                    $first_name = $row["fname"];
                    $last_name = $row["lname"];
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
                        checkMemberDb();
                        echo $success;
                        if ($success) {
                            include_once("session.php");
                            setLogin($first_name, $last_name);
                            header("Location: ../index.php");
                        } 
                        else {
                            echo "<h2>Oops!</h2>";
                            echo "<h4>Email not found or password doesn't match</h4>";
                            header( "refresh:2;url=../login.php" );
                        }
                        ?>
                    </div>
                </form>
            </div>
        </main>

        <?php
        include 'footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
