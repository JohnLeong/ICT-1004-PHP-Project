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
        ?>
        <main>
            <div class="registering">
                <form action="/action_page.php">
                    <div class="container">
                        <h2>Register</h2>
                        <p>Please fill up this form to create an account.</p>
                        <hr>

                        <label for="email"><b>Email&#42;</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required>

                        <label for="psw"><b>Password&#42;</b> (min. 8 character)</label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <label for="psw-repeat"><b>Repeat Password&#42;</b> (min. 8 character)</label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                        <label for="fname"><b>First Name</b></label>
                        <input type="text" placeholder="Enter First Name" name="fname">

                        <label for="lname"><b>Last Name&#42;</b></label>
                        <input type="text" placeholder="Enter Last Name" name="lname" required>

                        <label for="uname"><b>Username&#42;</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>

                        <label for="gender"><b>Gender&#42;</b></label>
                        <div class="row" id="genderbox">
                            <div class="col-2">

                                <label><input type="radio" name="gender" value="m" required>  Male</label>
                            </div>
                            <div class="col-4">

                                <label><input type="radio" name="gender" value="f">  Female</label>
                            </div>
                        </div>
                        <hr>
                        <p style="color:red"><i>&#42;Required Fields</i></p>
                        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                        <button type="submit" class="registerbtn">Register</button>
                    </div>

                    <div class="container signin">
                        <p>Already have an account? <a href="login.php">Sign in</a>.</p>
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

