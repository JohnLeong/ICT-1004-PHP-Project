<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Zenith - (Product Name in DB)</title>
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

        <!--Font Awesome-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--SEO-->
        <meta name="description" content="Buy high-quality shoes at great prices. Zenith offers a large variety of shoes from popular brands and provides world-wide shipping.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        include "inc/header.php"
        ?>
        <main>
            <!-- Product Details-->
            <div class="container" id="product-section">
                <div class="row">
                    <div class="col-md-6"><!--Product Image-->
                        <img class="productimgresize" src="img/AJ1.png" alt="Air Jordan 1"/>
                    </div><!--End of Product Image-->
                    <div class="col-md-6"><!--Product Info-->
                        <div class="row">
                            <div class="col-md-12">
                                <h2>AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT</h2>                            </h1>
                            </div>
                        </div><!--End of row-->
                        <!--<div class="row"><!--Product Type and SKU
                            <div class="col-md-12">
                                <span class="label label-primary">Lifestyle</span>
                                <span class="monospaced">EG SKU</span>
                            </div>
                        </div><!--End of row-->
                        <div class="row">
                            <div class="col-md-12">
                                <p class="description">
                                    Air Jordan 1 Retro High OG
                                </p>
                            </div>
                        </div><!--End of row-->
                        <div class="row">
                            <div class="col-md-12 bottom-rule">
                                <h2 class="product-price">$129.00</h2>
                            </div>
                        </div>

                        <!--<div class="row add-to-cart">
                            <div class="def-number-input number-input safari_only">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                <input class="quantity" min="0" name="quantity" value="1" type="number">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div>
                            <button type="button" class="btn btn-success btn-block">Add to Cart!</button>
                        </div>--><!--end of row-->
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Quantity" aria-label="Quantity"
                                       aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success btn-md" type="button" id="button-addon2">Add to Cart!</button>
                                </div>
                            </div>
                        </div>
                        <!-- Product Description Collapsible Panel-->
                        <div class="row product-description">
                            <div class="col-md-12">
                                <div class="wrapper center-block">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading active" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Description
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    Taking flight this season, step into business class with Air Jordan's latest iteration of the iconic Jordan 1 High OG, the 'First Class Flight'.<br><br>Brimming with character, the white and yellow high-top sneaker offers an aeronautically inspired style replete with model specific detailing.<br><br>Constructed with plush leather uppers and boasting premium under-foot comfort, this style will add the perfect boost of basketball aesthetics to your rotation.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Reviews
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    "These were playable, which is the main thing. If you wanted the look or styling of an Air Jordan I with modern tech you can either swap the insoles out for cushion or opt to purchase the Air Jordan I Alpha which offers many upgrades in every category, most notably the cushion with its Phylon midsole and full length bottom loaded Zoom Air." - WearTesters.com
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--End of Product Collapsible Panel-->
                    </div><!--End of row-->
                </div><!--End of container-->
                <!-- End of Product Details-->
            </div>
        </main>
        <?php
        include "inc/footer.php"
        ?>

        <!--JavaScript-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
