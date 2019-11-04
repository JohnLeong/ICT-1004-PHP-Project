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
                        <form class="form-inline active-cyan-3 active-cyan-4">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
                                   aria-label="Search">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <!--Promo line-->
    <div class="backingForPromo">
        <p class="promoStatment">
            Too expensive? <a href="register.php">Sign up</a> with us to get a 10% Discount for your first purchase!
        </p>
    </div>

    <!--Login + Shopping Cart-->
    <div>
        <p class="loggerNCart">
            <b>
                <a href="shoppingcart.php" >Shopping Cart <i class="fas fa-shopping-cart"></i></a> |
                <a href="login.php" >Login <i class="fas fa-sign-in-alt"></i></a>
            </b>
        </p>
    </div>
    <!--Header -->
    <div>
        <br>
        <a href="index.php">
            <img class="brandName" src="img/zenith-vector.svg" alt="ZENITH BRAND"/>
        </a>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('img/CarousellPic1.jpg')">
                    <div class="carousel-caption d-md-block" style="opacity: 1">
                        <h3 class="display-4, sliderword">SATISFYING THOUSANDS OF CUSTOMERS</h3>
                        <h3 class="display-4, sliderword">AND MANY MORE!</h3>
                        <p class="lead, sliderphase">What are you waiting for? Purchase your pair now!</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('img/CarousellPic2.jpg')">
                    <div class="carousel-caption d-md-block ">
                        <h3 class="display-4, sliderword">"FRESH"</h3>
                        <p class="lead, sliderphase">It's a Lifestyle, Not a Phase</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('img/CarousellPic3.jpg')">
                    <div class="carousel-caption d-md-block">
                        <h3 class="display-4, sliderword">PSYCHED BY YOU</h3>
                        <p class="lead, sliderphase">If you think you want it, get it!</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</header>