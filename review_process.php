<html>
    <head>
        <title>Zenith - (Product Name in DB)</title>
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

        <!--Font Awesome-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        date_default_timezone_set("Asia/Kuala_Lumpur");
        include "inc/header.php";

        $pid = $_POST['prodID'];
        
        
        if (!isset($_SESSION['zid'])) {
            $zid = 6;
        }else {
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
        $error="";
        $reviews = $errorMsg = "";
        $success = true;
        
        if (empty($_POST["reviewbox"])) {
            $errorMsg .= "Review  is required.<br>";
            $success = false;
        } else {
            $reviews = sanitize_input($_POST["reviewbox"]);
        }   
        $error.=$errorMsg;
        
        insertNewReviews();
        
        function insertNewReviews() {
            global $zid, $pid, $success, $errorMsg,$date, $reviews, $numOfReviews;
            $date = date('Y-m-d H:i:s');
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);


            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {

                // SQL Statement
                $sql = "INSERT INTO p5_2.products_review ";
                $sql .= "(product_ID, zmember_id, reviews, datetime) VALUES ";
                $sql .= "('". $pid ."' , '" . $zid . "' , '" . $reviews . "' , '" . $date ."' ) ";
                
                
                // Execute the query
                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
                    $success = false;
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
        <main>
            <div class ="container-fluid register">
                <form method="post">
                    <div class="form-group">
                        <?php
                        if ($success) {
                            echo "<h2>Your review has been submitted!!</h2>";
                            ?>
                            <input class="btn btn-default" type="button" value="Back To Product" 
                                   onclick="window.location.href='product_detail.php?productID=<?php echo $pid?>'" />
                            <input class="btn btn-default" type="button" value="Back To Shopping" 
                                   onclick="window.location.href='index.php'" />

                        <?php
                        } else {
                            echo "<h2>:(</h2>";
                            echo "<h4>The following input errors were detected:</h4>";
                            echo $errorMsg;
                            ?>
                            <input class="btn btn-default" type="button" value="Return to Product Page" 
                                   onclick="window.location.href='product_detail.php?productID=<?php echo $pid?>'" />
                               <?php } ?>
                    </div>
                </form>
            </div>
            
            
        </main>
        <?php
        include "inc/footer.php"
        ?>

        <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
