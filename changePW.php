<html>
    <head>
        <title>Zenith - Change Password</title>
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
    <script>

        function validatePwd() {
            var newpwd = document.forms["pwdform"]["newpwd"].value;
            var cfmnewpwd = document.forms["pwdform"]["cfmnewpwd"].value;
            var currpwd = document.forms["pwdform"]["currentpwd"].value;

            if (currpwd == null || currpwd == "") {
                alert('Current Password is empty');
                return false;
            } else if (newpwd == null || newpwd == "") {
                alert('New Password is empty');
                return false;
            } else if (currpwd == null || currpwd == "") {
                alert('Confirm Password is empty');
                return false;
            }

            if (newpwd == cfmnewpwd && currpwd != "") {
                return true;
            } else {
                alert('Confirm Password do not match with New Password');
                return false;

            }
        }
    </script>
    <body>
        <?php
        include 'inc/header.php';
        if (!isset($_SESSION['zid'])) {
//            header('Location: index.php');
            echo "<script>window.location.href='index.php'</script>";
        }
        $id = $first_name = $success = $zid = $oldpwd = $oldhash = $error = "";
        $newpwd = $newhash = "";
        $success = true;
        $change = 0;

        if (!isset($_POST['change'])) {
            $change = 0;
        } else {
            $change = $_POST["change"];
        }

        getMemberInfo();

        if ($change == 1) {
            updatePassword();

            if ($success == 1) {
                echo "<script type='text/javascript'>alert('Password Changed Successfully!');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Password changed failed');</script>";
                echo "<script type='text/javascript'>alert('" . $error . "');</script>";
            }
        }

        function updatePassword() {
            global $id, $first_name, $success, $zid, $oldpwd, $oldhash, $newhash, $newpwd, $DBhash;
            global $ccpwd, $error;

            $id = $_SESSION['zid'];
//            
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            $oldpwd = sanitize_input($_POST["currentpwd"]);
            $newpwd = sanitize_input($_POST["newpwd"]);

            $oldhash = password_hash($oldpwd, PASSWORD_DEFAULT);
            $newhash = password_hash($newpwd, PASSWORD_DEFAULT);
            $ccpwd = mysqli_real_escape_string($conn, $oldpwd);


            // Check current password match with DB password
            if (password_verify($ccpwd, $DBhash)) {
                // Check connection
                if ($conn->connect_error) {
                    $error = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $stmt = $conn->prepare("UPDATE p5_2.zenith_members SET password = ? where zmember_id=?");
                    $stmt->bind_param("si", $newhash, $id);

                    $result = $stmt->get_result();

                    if ($stmt->execute() == true) {
                        $success = true;
                    } else {
                        $error .= $conn->error;
                        $success = false;
                    }
                }
            } else {
                $success = false;
                $error .= "Password do not match in database";
            }
        }

        function getMemberInfo() {
            global $id, $first_name, $success, $zid, $DBpwd, $DBhash;
            $id = $_SESSION['zid'];
            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $stmt = $conn->prepare("SELECT * FROM p5_2.zenith_members WHERE zmember_id= ?");
                $stmt->bind_param("i", $id);

                // Execute the query
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_name = $row["fname"];
                    $DBhash = $row["password"];
                } else {
                    $success = false;
                }
                $result->free_result();
            }
            $conn->close();
        }

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <main>
            <div class="profilepage">
                <div class="row align-items-center my-5">
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-12">
                        <h2 class="mb-4">Change Password</h2>
                        <div id="profbox">
                            <form action="<?php echo htmlspecialchars('changePW.php') ?>" onsubmit="return validatePwd()"method="POST" name="pwdform">  
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="mb-4">User first name: <?php echo $first_name ?></h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="currentpwd">Current Password: </label>
                                                <input class="form-control" type="password" name="currentpwd" id="currentpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="newpwd">New Password: </label>
                                                <input class="form-control" type="password" name="newpwd" id="newpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="cfmnewpwd">Confirm New Password: </label>
                                                <input class="form-control "type="password" name="cfmnewpwd" id="cfmnewpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-align-right">
                                        <input type="hidden" name="change" value="1"/>
                                        <button type="submit" onclick="window.location = '<?php echo htmlspecialchars('profile.php') ?>'" class="btn btn-outline-dark" id="editBtn">Cancel</button>
                                        <button type="submit" class="btn btn-outline-dark" id="editBtn">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End of prof box-->

                    </div> <!-- Container for the whole of change password-->
                </div>
                <!-- /.col-md-4 -->
            </div>
        </main>
    </body>
</html>
