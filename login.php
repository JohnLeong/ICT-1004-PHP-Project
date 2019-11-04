<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - Login</title>
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
            <!--Main Content-->
            <!--1st Row-->
            <div class="loginpage">
                <div class="row">
                    <!--Login Credentials, 6 columns-->
                    <div class="col">
                        <div class="col-lg-10" >
                            <h2>LOGIN</h2>
                            <form class="form-signin" name="loginForm" action="login.html">
                                <div class="form-label-group">
                                    <label for="inputEmail">Email Address:</label>
                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
                                </div>

                                <div class="form-label-group">
                                    <label for="inputPassword">Password:</label>
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                </div>
                                <div>
                                    <a href="#" class="forgot">Forgot Password?</a>
                                </div>
                                <hr class="hr-with-text">
                                <div class="checkbox">
                                    <label><input type="checkbox"> Remember me</label>
                                </div>
                                <button class="btn text-uppercase" type="submit">LOGIN <i class="fas fa-sign-in-alt"></i></button>

                                <!--For Deliverable 1 only-->
                                <p>This <a href="profile.php">link</a> is only for Deliverable 1 usage and will be removed for Deliverable 2.</p>

                                <p class="hr-or">or</p>
                                <div style="text-align: center">
                                    <button class="loginBtn loginBtn--facebook">
                                        Login with Facebook
                                    </button>

                                    <button class="loginBtn loginBtn--google">
                                        Login with Google
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col">
                        <div class="col-lg-10" >
                            <h2>NOT A MEMBER?</h2>
                            <div class="forRegister">
                                <p>Create an account right now and receive a 10% promo code! This is for first timers only! Hurry up and register now!</p>
                                <a href="register.php"><button class="btn text-uppercase" type="button">Register <i class="fas fa-user-edit"></i></button></a>
                            </div>
                        </div>
                    </div>
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
