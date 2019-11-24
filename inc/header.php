<?php
    ini_set('session.cookie_httponly', true);
    
    include_once("session.php");
    
    //Regenerate new session id everytime user change page.
    session_regenerate_id(true);
    
    if (isset($_SESSION['last_ip']) === false) {
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
    }
    
    if ($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
        session_unset();
        session_destory;
    }
    
    // Log user out if inactive for 20minutes
    $inactive = 1200;
    // check to see if $_SESSION['Logstatus'] is set
    if(isset($_SESSION['Logstatus']) ) {
        $session_life = time() - $_SESSION['Logstatus'];
        if($session_life > $inactive)
        { 
            session_unset();
            session_destroy(); 
            header("Location: index.php?inactive");
        } else {
            $_SESSION['Logstatus'] = time();
        }
    }
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<header>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">ZENITH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="nav navbar-nav navbar-left">
                    <li class="nav-item">
                        <a class="nav-link" href="women.php">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="men.php">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="locateus.html">Locate Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li> <!-- Search bar -->
                        <!-- Search form -->
                        <form class="form-inline active-cyan-3 active-cyan-4" method="post" action="search.php">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" name="searchbox" placeholder="Search" aria-label="Search">
                            <input type="submit" style="position: absolute; left: -9999px"/>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <!--Promo line-->
    <?php
    if (isset($_GET['inactive'])) {
        echo '<script type="text/javascript">alert("You have been inactive for more than 20 minutes.");</script>';
    }
    if (isset($_SESSION['name'])) {
        $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            global $noOfitem;
            $id = $_SESSION['zid'];
            $sql = "SELECT * FROM zshoppingcart WHERE zmember_id =$id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $noOfitem += $row['quantity'];
                }
            }
        }
    }
    if (isset($_SESSION['name'])) {?>
            <div>
                <p class="loggerNCart">
                    <b><?php
                        echo "<a href=account.php>Welcome, {$_SESSION['name']}! </a>";
                        ?>
                            <i class="fas fa-user-circle"></i> | 
                            <a href="shoppingcart.php" >Shopping Cart <i class="fas fa-shopping-cart"> 
                            <?php
                                echo '<span id="cart-item" class="badge badge-danger">'. $noOfitem .'</span></i></a> |'; ?>
                        <a href="../ICT1004_PHP_Project/inc/logout.php" >Logout <i class="fas fa-sign-in-alt"></i></a> 
                    </b>
                </p>
            </div> <?php
    }
    else {?>
            <div class="backingForPromo">
                <p class="promoStatment">
                    Too expensive? <a href="../register.php">Sign up</a> with us to get a 10% Discount for your first purchase!
                </p>
            </div>
    <?php
        if(!isset($_GET['log'])) {?>
            <!--Login + Shopping Cart-->
            <div>
                <p class="loggerNCart">
                    <b>
                        <a href="ICT1004_PHP_Project/../login.php?log" >Login <i class="fas fa-sign-in-alt"></i></a>
                    </b>
                </p>
            </div> <?php
        }    
    }?>
    
    <br>
    <a href="index.php">
        <img class="brandName" src="img/zenith-vector.svg" alt="ZENITH BRAND"/>
    </a>
</header>