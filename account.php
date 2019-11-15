<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Account Page</title>
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

        $success = true;
        $id = $_SESSION['zid'];
        $delete = 0;
        
        getMemberInfo();


        if (!isset($_POST['delete'])) {
            $delete = 0;
        } else {
            $delete = $_POST["delete"];
        }
        if ($delete == 1) {
            echo "";
            echo "<script>alert('Goodbye :(');</script>";
            deleteMember();
            session_destroy();
            echo "<script>window.location.reload(true);</script>";
        }

        function getMemberInfo() {
            global $id, $first_name, $last_name, $success, $error;
            $id = $_SESSION['zid'];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $error = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $stmt = $conn->prepare("SELECT fname,lname FROM p5_2.zenith_members WHERE zmember_id= ?");
                $stmt->bind_param("i", $id);

                // Execute the query
                $stmt->execute();

                // Execute the query
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
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
            <div class="profilepage">
                <div class="row align-items-center my-5">
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-12">
                        <h2 class="mb-4">Welcome <?php echo $first_name ?> to your Account Page!</h2>
                        <?php echo $error?>
                        <div class="row">
                            <button type="submit" onclick="window.location = '<?php echo htmlspecialchars('profile.php') ?>'" class="btn btn-outline-warning" id="profBtn">Profile Page</button>
                        </div>
                        <div class="row">
                            <button type="submit" onclick="window.location = '<?php echo htmlspecialchars('orderhistory.php') ?>'" class="btn btn-outline-primary" id="histBtn">Order History</button>
                        </div>
                        <div class="row">
                            <button type="submit" onclick="window.location = '<?php echo htmlspecialchars('changePW.php') ?>'" class="btn btn-outline-info" id="pwdBtn">Change Password</button>
                        </div>
                    </div> <!-- Container for the whole of register-->
                </div>
                <!-- /.col-md-4 -->
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
