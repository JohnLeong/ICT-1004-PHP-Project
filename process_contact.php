<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - WOMEN</title>
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
        <main>
            <?php
            //Constants for accessing our DB:
            define("DBHOST", "161.117.122.252");
            define("DBNAME", "p5_2");
            define("DBUSER", "p5_2");
            define("DBPASS", "yzhbGyqP87");

            $name = $email = $errorMsg = "";
            $success = true;
            if (empty($_POST["email"])) {
                $errorMsg .= "Email is required.<br>";
                $success = false;
            } else {
                $email = sanitize_input($_POST["email"]); // Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }
            }

            $name = sanitize_input($_POST["name"]);

            if (empty($_POST["message"])) {
                $errorMsg .= "A message is required.<br>";
                $success = false;
            } else {
                $message = sanitize_input($_POST["message"]);
            }

            if ($success) {
                echo "<br>";
                echo "<h4>Your message has been submitted!</h4>";
                echo "<br>";
                saveMessageToDB();
            } else {
                echo "<br>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
            }//Helper function that checks input for malicious or unwanted content.

            function saveMessageToDB() {
                global $name, $email, $message, $errorMsg, $success;
                // Create connection
                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $sql = "INSERT INTO p5_2.contact_us_info (email, name, message)";
                    $sql .= " VALUES('$email', '$name', '$message')";
                    // Execute the query
                    if (!$conn->query($sql)) {
                        $errorMsg = "Database error: " . $conn->error;
                        $success = false;
                    } else {
                        $errorMsg .= "Successfully added to database";
                    }
                }
                $conn->close();
            }

            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </main>
        <?php
        include 'inc/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>