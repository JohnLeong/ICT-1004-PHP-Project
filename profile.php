<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - Profile</title>
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

        getMemberInfo();
        
        if ($gender == null || $dob == null || $mobile == null || $country == null || $city == null || $address == null) {
            echo "<script type='text/javascript'>alert('Please complete your profile information :)');</script>";
            echo "<script>window.location.href='editprofile.php'</script>";
        }
        function getMemberInfo() {
            global $id, $email, $first_name, $last_name, $dob, $gender, $mobile, $country, $city, $address, $success, $zid;
            $id = $_SESSION['zid'];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $sql = "SELECT * FROM p5_2.zenith_members WHERE ";
                $sql .= "zmember_id='$id'";

                // Execute the query
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_name = $row["fname"];
                    $last_name = $row["lname"];
                    $email = $row["email"];
                    $dob = $row["dob"];
                    $gender = $row["gender"];
                    $mobile = $row["mobile"];
                    $country = $row["country"];
                    $city = $row["city"];
                    $address = $row["address"];
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
                        <h2 class="mb-4">View My Profile</h2>
                        <div id="profbox">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6"> <!-- Start of Profile Settings-->
                                        <h3 class="mb-4">Profile Settings</h3><hr/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>First Name:</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="">Last Name:</label>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $first_name ?></p>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $last_name ?></p>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Date of Birth:</label>
                                            </div>
                                            <div class="col-6">
                                                <label>Gender: </label>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $dob ?></p>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $gender ?></p>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Email:</label>
                                            </div>
                                            <div class="col-6">
                                                <label>Mobile:</label>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $email ?></p>
                                            </div>
                                            <div class="col-6">
                                                <p><?php echo $mobile ?></p>
                                            </div>
                                        </div>
                                        <hr/>
                                    </div> <!-- End of Profile Settings-->
                                    <!--######################################################################################################################################################### -->                            
                                    <div class="col-lg-6">
                                        <div id="locbox">
                                            <h3 class="mb-4">Location</h3><hr/>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Country/Region: </label>
                                                </div>
                                                <div class="col-6">
                                                    <label>City: </label>
                                                </div>
                                                <div class="col-6">
                                                    <p><?php echo $country ?></p>
                                                </div>
                                                <div class="col-6">
                                                    <p><?php echo $city ?></p>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label> Address: </label>
                                                </div>
                                                <div class="col-12">
                                                    <p><?php echo $address ?></p>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End of Register box-->
                        <div class="text-align-right">
                            <button type="submit" onclick="window.location = '<?php echo htmlspecialchars('editProfile.php') ?>'" class="btn btn-outline-dark" id="editBtn">Edit</button>
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
