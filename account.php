<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
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

        <!-- JQuery for Shadow Effect -->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script type="text/javascript">
            $(document).ready(function () {
                // executes when HTML-Document is loaded and DOM is ready
                console.log("document is ready");


                $(".card").hover(
                        function () {
                            $(this).addClass('shadow-lg').css('cursor', 'pointer');
                        }, function () {
                    $(this).removeClass('shadow-lg');
                }
                );

                // document ready  
            });
        </script>
    </head>
    <body>
        <?php
        include 'inc/header.php';
        if (!isset($_SESSION['name'])) {
//            header('Location: index.php');
            echo "<script>window.location.href='index.php'</script>";
        }

        $success = true;
        $id = $_SESSION['zid'];
        
        if ($id == 3) {
            echo "<script>window.location.href='adminpage.php'</script>";
        }
        

        getMemberInfo();

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

                        <div class="container">
                            <div class="card-deck">
                                <div class="card">
                                    <a style="color:black" class="account-card"href="profile.php">
                                        <img class="card-img-top" src="img/profile.jpg" alt="View or Change Profile Settings">
                                        <!-- SOURCE: https://www.kissclipart.com/user-edit-icon-clipart-computer-icons-user-profile-v1ctia/ -->
                                        <div class="card-body">
                                            <h5 class="card-title">Profile Settings</h5>
                                            <p class="card-text">View & Edit Your Profile</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="card">
                                    <a style="color:black" class="account-card" href="orderhistory.php">
                                        <img class="card-img-top" src="img/order-history.jpg" alt="Order History">
                                        <!-- SOURCE: https://www.kissclipart.com/purchase-history-icon-clipart-computer-icons-royal-7p5blz/ -->
                                        <div class="card-body">
                                            <h5 class="card-title">Order History</h5>
                                            <p class="card-text">View Your Purchase History</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="card">
                                    <a style="color:black" class="account-card" href="changePW.php">
                                        <img class="card-img-top" src="img/password-image.jpg" alt="Change Password">
                                        <!-- SOURCE: https://www.kissclipart.com/password-clipart-password-policy-computer-security-zk32t8/ -->
                                        <div class="card-body">
                                            <h5 class="card-title">Change Password</h5>
                                            <p class="card-text">Change Your Password</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.container -->
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
