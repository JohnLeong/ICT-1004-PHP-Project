<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - MEN</title>
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
            <div>
                <h2>Men's Footwear</h2>
                <div class="row">
                    <!--Filter column-->
                    <div class= "col-md-3"> <!--Hidden on all except XL-->
                        <div class="card">
                            <article class="card-group-item">
                                <header class="card-header">
                                    <h6 class="title">Brands</h6>
                                </header>
                                <div class="card-body">
                                    <form>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Nike</span>
                                        </label> <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Under Armour</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Adidas</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Dr. Martens</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">On</span>
                                        </label>  <!-- form-check.// -->
                                    </form>
                                </div><!-- card-body.// -->
                            </article> <!-- card-group-item.// -->

                            <article class="card-group-item">
                                <header class="card-header">
                                    <h6 class="title">Types</h6>
                                </header>
                                <div class="card-body">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                        <span class="form-check-label">Lifestyle</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                        <span class="form-check-label">Training & Gym</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                        <span class="form-check-label">Running</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                        <span class="form-check-label">Walking</span>
                                    </label>
                                </div> <!-- card-body.// -->
                            </article> <!-- card-group-item.// -->
                        </div> <!-- card.// -->
                    </div>
                    <!--Products Column-->
                    <div class= "col-md-9">
                        <!--Products Row 1-->
                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/AJ1.PNG" alt="AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT"/>
                                        <h3 class="card-title">AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="productdetails.html" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2019%2F09%2Fair-jordan-first-class-03.jpg?q=90&w=1400&cbr=1&fit=max">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/AM1.PNG" alt="NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'"/>
                                        <h3 class="card-title">NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">3 Colours</p>

                                    </div>
                                    <div class="card-footer">
                                        <a href="productdetails2.html" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_prod_ss/w_960%2Cc_limit%2Cf_auto/jysjd3c50qsqndqoxq0p/air-max-90-new-species-release-date.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/DrM.PNG" alt="DR. MARTENS X HENDER SCHEME 1461 SHOE"/>
                                        <h3 class="card-title">DR. MARTENS X HENDER SCHEME 1461 SHOE</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">1 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="productdetails3.html" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://end-features.cdn.prismic.io/end-features/2f0a022a143b6d74a26dc62ff591eb6022ee1c07_dm_hs_03.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Products Row 2-->

                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/JORDAN4.jpg" alt="Air Jordan 4 Retro"/>
                                        <h3 class="card-title">Air Jordan 4 Retro</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">1 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2019%2F07%2Fnike-air-jordan-4-cool-grey-2004-2019-30th-anniversary-re-release-stockx-1.jpg?q=70&w=320&cbr=1&fit=max">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/PHANTOM.jpg" alt="NIKE EPIC PHANTOM REACT FLYKNIT"/>
                                        <h3 class="card-title">Nike Epic Phantom React Flyknit</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_default/bno8lsfowpbiyfrfdbun/epic-phantom-react-flyknit-mens-running-shoe-JSfMLc.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/EPICREACT.jpg" alt="NIKE EPIC REACT FLYKNIT"/>
                                        <h3 class="card-title">Nike Epic React Flyknit</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">10 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_default/eqy88xogmvva3bjlgv4k/epic-react-flyknit-2-running-shoe-2pbhWF.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <!-- Product Row 4-->
                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/GORETEX.jpg" alt="Converse Chuck 70 GORE-TEX High Top"/>
                                        <h3 class="card-title">Converse Chuck 70 GORE-TEX High Top</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">2 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dw62716844/images/a_08/164912C_A_08X1.jpg?sw=406">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/NANO8.jpg" alt="REEBOK CROSSFIT NANO 8 FLEXWEAVE®"/>
                                        <h3 class="card-title">REEBOK CROSSFIT NANO 8 FLEXWEAVE®</h3>
                                        <p class="productdescription">Men's Trainers</p>
                                        <p class="productoption">1 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="http://www.reebok.com/dis/dw/image/v2/AAJP_PRD/on/demandware.static/-/Sites-reebok-products/default/dwee8e9038/zoom/CN1022_07.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/FLEXAGON.jpg" alt="REEBOK FLEXAGON 2.0 FLEXWEAVE® LES MILLS® SHOES"/>
                                        <h3 class="card-title">REEBOK FLEXAGON 2.0 FLEXWEAVE® LES MILLS® SHOES</h3>
                                        <p class="productdescription">Men's Trainers</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.reebok.cz/dw/image/v2/AAJP_PRD/on/demandware.static/-/Sites-reebok-products/default/dwcf50ae90/zoom/DV9578_01_standard.jpg?sw=580&amp%3Bsfrm=jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Row 5-->
                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/JJ3.jpg" alt="REEBOK JJ III SHOES"/>
                                        <h3 class="card-title">REEBOK JJ III SHOES</h3>
                                        <p class="productdescription">Men's Trainers</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.reebok.com/images/w_280%2Ch_280%2Cf_auto%2Cq_auto:sensitive/5f3ebcda7d99459db763aa730131fdd1_9366/reebok-jj-iii-shoes.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/ZIGPULSE.jpg" alt="REEBOK ZIG PULSE SHOES"/>
                                        <h3 class="card-title">REEBOK ZIG PULSE SHOES</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.reebok.com/images/w_840,h_840,f_auto,q_auto:sensitive,fl_lossy/ed584ce5e14c41448014a9a6002c32f6_9366/Reebok_Zig_Pulse_3_Black_DV5131_03_standard.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/FLASHFILM.jpg" alt="REEBOK FLASHFILM SHOES"/>
                                        <h3 class="card-title">REEBOK FLASHFILM SHOES</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.reebok.com/images/w_280%2Ch_280%2Cf_auto%2Cq_auto:sensitive%2Cfl_lossy/6896fac67e704c09a494aa47002052a7_9366/reebok-flashfilm-shoes.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Product Row 6-->
                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/CLOUDDIP.jpg" alt="On CLOUDDIP"/>
                                        <h3 class="card-title">On CLOUD DIP</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://images.ctfassets.net/od02wyo8cgm5/6ueuCccI1XR65Zd6nnRHBC/e96c13287624033124885aff6921052a/cloud_dip-fw19-desert_clay-m-g1.png?w=1100&h=1100&fl=progressive&q=61&bg=rgb:f7f7f7&fm=jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/CLOUDACE.jpg" alt="On Cloudace"/>
                                        <h3 class="card-title">On Cloudace</h3>
                                        <p class="productdescription">Men's Running Shoe</p>
                                        <p class="productoption">4 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://images.ctfassets.net/od02wyo8cgm5/2YU4vuKJVsQVfnBVzbXxFs/d67a8dda3b503514498c1b9939d16d67/cloudace-fw19-mist_stone-m-g1.png?w=1100&h=1100&fl=progressive&q=61&bg=rgb:f7f7f7&fm=jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize fitimage" src="img/CLOUDROCK.jpg" alt="On Cloudrock Waterproof"/>
                                        <h3 class="card-title">On Cloudrock Waterproof</h3>
                                        <p class="productdescription">Men's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://images.ctfassets.net/od02wyo8cgm5/1VTtQMteoYrCocBkrCqnfO/1eb1c49f49656ec2ab37f5a84b03f9f6/cloudrock_waterproof-fw19-all_black-m-g1.png?w=1100&h=1100&fl=progressive&q=61&bg=rgb:f7f7f7&fm=jpg">Image source</a>
                                    </div>
                                </div>
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