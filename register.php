<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html lang="en">
    <head>
        <title>Zenith - Register Now!</title>
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
        if(isset($_SESSION['name'])){
            header('Location: index.php');
        }
        if (isset($_GET['emailexist'])){
            echo '<script type="text/javascript">alert("Email entered have already been registered.");</script>';
        }
        if (isset($_GET['pwnotmatch'])){
            echo '<script type="text/javascript">alert("Your Passwords do not match. Please try again.");</script>';
        }
        ?>
        <main>
            <div class="registering">
                <div class="container">
                    <h2>Register</h2>
                    <p>Please fill up this form to create an account.</p>
                    <hr>
                    <form action="inc/register_process.php" name="myForm" onsubmit="return validateForm()" method="POST">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" name="first_name" class="form-control" required id="fname" 
                                   pattern="[A-Za-z]{1,}" title="Please enter Alphabet Characters only.">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" required id="lname" 
                                   pattern="[A-Za-z]{1,}" title="Please enter Alphabet Characters only.">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                                   required id="email" title="Please enter a valid email addresss.">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" placeholder="Password" id="password" required name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" placeholder="Confirm Password" id="confirm_password" required name="confirm_password" class="form-control" id="cpw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                        <p style="color:red"><i>&#42;Required Fields</i></p>
                        <div class="checkbox">
                            <label><input type="checkbox" required > Agree to our <a href="#">Terms & Privacy</a></label>
                        </div>
                        <hr>
                        <button type="submit" class="registerbtn" name="register_submit">Register</button>
                    </form>
                </div>

                <div class="container signin">
                    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
                </div>
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

