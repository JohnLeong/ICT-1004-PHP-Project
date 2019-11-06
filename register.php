<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
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
        ?>
        <main>
            <div class="registering">
                <div class="container">
                    <h2>Register</h2>
                    <p>Please fill up this form to create an account.</p>
                    <hr>
                    <form action="register_process.php" name="myForm" onsubmit="return validateForm()" method="POST">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" name="first_name" class="form-control" required id="fname">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" required id="lname" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required id="email" >
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" placeholder="Password" id="password" required name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" placeholder="Confirm Password" id="confirm_password" required name="confirm_password" class="form-control" id="cpw" >
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

