<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith</title>
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
        include 'inc/headerMain.php';
        ?>
        <main>
            <div>
                <div class="row">
                    <h2 class="col">New Releases!</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <img class="productimgresize" src="img/AJ1.PNG" alt="AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT"/>
                                <h3 class="card-title">AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT</h3>
                                <p class="productdescription">White/Dynamic Yellow-Black</p>
                            </div>
                            <div class="card-footer">
                                <a href="productdetails.html" class="btn btn-secondary btn-sm">More Info</a>
                                <a href="https://sneakernews.com/2019/05/30/air-jordan-1-first-class-flight/">Image source</a> 
                            </div>
                        </div>
                    </div>

                    <!--col-md-4 -->
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <img class="productimgresize" src="img/AM1.PNG" alt="NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'"/>
                                <h3 class="card-title">NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'</h3>
                                <p class="productdescription">PURE PLATINUM & BIO GREEN</p>
                            </div>
                            <div class="card-footer">
                                <a href="productdetails2.html" class="btn btn-secondary btn-sm">More Info</a>
                                <a href="https://c.static-nike.com/a/images/t_prod_ss/w_960%2Cc_limit%2Cf_auto/jysjd3c50qsqndqoxq0p/air-max-90-new-species-release-date.jpg">Image source</a>
                            </div>
                        </div>
                    </div>

                    <!--col-md-4 -->
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <img class="productimgresize" src="img/DrM.PNG" alt="DR. MARTENS X HENDER SCHEME 1461"/>
                                <h3 class="card-title">DR. MARTENS X HENDER SCHEME 1461 SHOE</h3>
                                <p class="productdescription">BLACK & NATURAL</p>
                            </div>
                            <div class="card-footer">
                                <a href="productdetails3.html" class="btn btn-secondary btn-sm">More Info</a>
                                <a href="https://end-features.cdn.prismic.io/end-features/2f0a022a143b6d74a26dc62ff591eb6022ee1c07_dm_hs_03.jpg">Image source</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="img/brandPlaceholder.jpg" alt="BrandImage">
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="banner">
                        <p class='bannerheader'>Zenith</p>
                        <p class='bannertagline'>Making your dream shoes come true</p>
                    </div>
                </div>
                <!-- /.col-lg-6 -->
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
