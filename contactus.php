<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html lang="en">
    <head>
        <title>Zenith - Contact Us</title>
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
        <meta name="description" content="Send us a message! Zenith values the feedback from its customers greatly.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        include 'inc/header.php';
        
        if(isset($_GET['error'])){
            echo '<script type="text/javascript">alert("An error has occured. Please try again later.");</script>';
        }
        if (isset($_GET['successful'])) {
        echo '<script type="text/javascript">alert("Your message has been sent!");</script>';
        }
        ?>
        <main>
            <div>
                <h2>Contact Us</h2>
                <form class="contact-form" action="inc/process_contact.php" method="post">
                    <div class="form-group">
                        <label for="name">Name (optional)</label>
                        <input class="form-control" id="name" name="name" rows="1"></input>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                    <br>
                    <br>
                    <a href="mailto:contact@zenith.com">Email us directly instead</a>
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