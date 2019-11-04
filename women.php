<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - WOMEN</title>
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
                <h2>Women's Footwear</h2>
                <div class="row">
                    <!--Filter column-->
                    <div class= "col-md-3"> 
                        <div class="card">
                            <article class="card-group-item">
                                <header class="card-header">
                                    <h6 class="title">Brands</h6>
                                </header>
                                <div class="card-body">
                                    <form>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Adidas</span>
                                        </label> <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Nike</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Under Armour</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">Converse</span>
                                        </label>  <!-- form-check.// -->
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-label">On</span>
                                        </label>  <!-- form-check.// -->
                                    </form>
                                </div> <!-- card-body.// -->
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
                                        <img class="productimgresize" src="img/AF1-Shadow.jpg" alt="Nike AF-1 Shadow"/>
                                        <h3 class="card-title">Nike AF-1 Shadow</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/f_auto/q_auto/t_PDP_864_v1/vf4nffms4zmfcmrt6ty2/af-1-shadow-shoe-n7WF4B.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/AIRMAX.jpg" alt="Nike Air Max 270 React"/>
                                        <h3 class="card-title">Nike Air Max 270 React</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">5 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://sneakerparadies.de/wp-content/uploads/2019/09/efsef-300x300.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/JOYRIDE.jpg" alt="Nike Joyride Optik"/>
                                        <h3 class="card-title">Nike Joyride Optik</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_default/caffsxgzhruk0pl6oi1l/joyride-optik-shoe-51TfbD.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Products Row 2-->
                        <div class ="row">

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/PEGASUSTURBO2.jpg" alt="Nike Zoom Pegasus Turbo 2"/>
                                        <h3 class="card-title">Nike Zoom Pegasus Turbo 2</h3>
                                        <p class="productdescription">Women's Running Shoe</p>
                                        <p class="productoption">1 Colour</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_PDP_1728_v1/f_auto,b_rgb:f5f5f5/e8xjlpjjg01gcnvjixi8/zoom-pegasus-turbo-2-running-shoe-0PSPkN.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/JOYRIDERUN.jpg" alt="Nike Joyride Run Flyknit"/>
                                        <h3 class="card-title">Nike Joyride Run Flyknit</h3>
                                        <p class="productdescription">Women's Running Shoe</p>
                                        <p class="productoption">4 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://c.static-nike.com/a/images/t_default/mbmn4yusr7kkkndboc94/joyride-run-flyknit-running-shoe-9R1ktX.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/FALCON.jpg" alt="adidas FALCON SHOES"/>
                                        <h3 class="card-title">adidas FALCON SHOES</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2019%2F08%2Fbest-sneaker-releases-august-2019-week-2-2.jpg?q=70&w=580&cbr=1&fit=max">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <!--Products Row 3-->
                        <div class ="row">

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/ALPHAEDGE.jpg" alt="adidas ALPHAEDGE 4D PARLEY SHOES"/>
                                        <h3 class="card-title">adidas ALPHAEDGE 4D PARLEY SHOES</h3>
                                        <p class="productdescription">Women's Running Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.adidas.com/images/w_280%2Ch_280%2Cf_auto%2Cq_auto:sensitive/0a59655816254e22989aaa250143dd45_9366/alphaedge-4d-parley-shoes.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/ULTRABOOST19.jpg" alt="adidas ULTRABOOST 19 SHOES"/>
                                        <h3 class="card-title">adidas ULTRABOOST 19 SHOES</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://cdn.sportdepot.bg/files/catalog/list/G27483_01.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/MISSONI.jpg" alt="adidas ULTRABOOST X MISSONI SHOES"/>
                                        <h3 class="card-title">adidas ULTRABOOST X MISSONI SHOES</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.adidas.com/images/w_280%2Ch_280%2Cf_auto%2Cq_auto:sensitive/b9ef937e4b2844478a36a9bb007ea4fb_9366/ultraboost-x-missoni-shoes.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Products Row 4-->
                        <div class ="row">

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CHUCK70.jpg" alt="Converse Chuck 70 High Top"/>
                                        <h3 class="card-title">Converse Chuck 70 High Top</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">9 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dw4ed7e63c/images/a_107/162054C_A_107X1.jpg?sw=964">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CHUCK70LOW.png" alt="Converse Custom Chuck 70 Low Top"/>
                                        <h3 class="card-title">Converse Custom Chuck 70 Low Top</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">7 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dwce1af892/images/a_107/164946C_A_107X1.jpg?sw=964">Image source</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CHUCKALLSTAR.jpg" alt="Converse Chuck Taylor All Star Seasonal Color High Top"/>
                                        <h3 class="card-title">Converse Chuck Taylor All Star High Top</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">11 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dw3f4546cb/images/a_08/164933F_A_08X1.jpg?sw=406">Image source</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class ="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/AIRMAX2.jpg" alt="Nike SB Air Max Stefan Janoski 2"/>
                                        <h3 class="card-title">Nike SB Air Max Stefan Janoski 2</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2019%2F02%2Fnike-sb-janoski-2-release-info-007.jpg?q=75&w=800&cbr=1&fit=max">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/UAAPEX.jpg" alt="UA HOVR™ Apex Training Shoes"/>
                                        <h3 class="card-title">UA HOVR™ Apex Training Shoes</h3>
                                        <p class="productdescription">Women's Training Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://underarmour.scene7.com/is/image/Underarmour/3022209-200_DEFAULT?bgc=f0f0f0&wid=640&hei=480&size=440%2C420">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CHUCKSLIP.jpg" alt="Converse Chuck Taylor All Star Slip"/>
                                        <h3 class="card-title">Converse Chuck Taylor All Star</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">5 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://www.converse.com/dw/image/v2/BCZC_PRD/on/demandware.static/-/Sites-cnv-master-catalog/default/dwf856ee0b/images/a_08/M7652_A_08X1.jpg?sw=406">Image source</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Product Row 6-->
                        <div class="row">
                            <!--col-md-4 -->
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/NITEJOGGER.jpg" alt="adidas NITE JOGGER SHOES"/>
                                        <h3 class="card-title">Adidas NITE JOGGER SHOES</h3>
                                        <p class="productdescription">Women's Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://assets.adidas.com/images/w_280%2Ch_280%2Cf_auto%2Cq_auto:sensitive/f0fc7272dfd84773801da9ba0123ad6d_9366/nite-jogger-shoes.jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CLOUDSTRATUS.jpg" alt="On Cloudstratus"/>
                                        <h3 class="card-title">On Cloudstratus</h3>
                                        <p class="productdescription">Women's Running Shoe</p>
                                        <p class="productoption">2 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://images.ctfassets.net/od02wyo8cgm5/6ueuCccI1XR65Zd6nnRHBC/e96c13287624033124885aff6921052a/cloud_dip-fw19-desert_clay-m-g1.png?w=1000&h=1000&fl=progressive&q=71&fit=pad&bg=rgb:f7f7f7&fm=jpg">Image source</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img class="productimgresize" src="img/CLOUDTERRY.jpg" alt="On Cloud Terry"/>
                                        <h3 class="card-title">On Cloud Terry</h3>
                                        <p class="productdescription">Women's Running Shoe</p>
                                        <p class="productoption">3 Colours</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-secondary btn-sm">More Info</a>
                                        <a href="https://images.ctfassets.net/od02wyo8cgm5/6nW9H5UY5v5080aihtMNNh/50fd35e04b443c11f9c355581b0ab99a/cloud_terry-fw19-silver-m-g1.png?w=1000&h=1000&fl=progressive&q=71&fit=pad&bg=rgb:f7f7f7&fm=jpg">Image source</a>
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