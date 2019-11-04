<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
        <title>Zenith - Shopping Cart</title>
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
            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody id="carttab">
                                    <tr id="row1">
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <img src="img/AJ1.PNG" class="d-block ui-w-40 ui-bordered mr-4" alt="AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT">
                                                <div class="media-body">
                                                    <a href="#" class="d-block text-dark">AIR JORDAN 1 RETRO HIGH OG - FIRST CLASS FLIGHT</a>
                                                    <small>
                                                        <span class="text-muted">Color:</span> WHITE & YELLOW
                                                        <span class="text-muted">Size: </span> US 10.5 &nbsp;
                                                        <span class="text-muted">Ships from: </span> United States or America
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 309.00</td>
                                        <td class="align-middle p-4"><input type="text" class="form-control text-center" value="1"></td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 309.00</td>
                                        <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove" onclick="delCartItem(1)">×</a></td>
                                    </tr>

                                    <tr id="row2">
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <img src="img/AM1.PNG" class="d-block ui-w-40 ui-bordered mr-4" alt="NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'">
                                                <div class="media-body">
                                                    <a href="#" class="d-block text-dark">NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'</a>
                                                    <small>
                                                        <span class="text-muted">Color:</span> PURE PLATINUM & BIO GREEN
                                                        <span class="text-muted">Size: </span> US 9.0 &nbsp;
                                                        <span class="text-muted">Ships from: </span> United States or America
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 185.00</td>
                                        <td class="align-middle p-4"><input type="text" class="form-control text-center" value="1"></td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 185.00</td>
                                        <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove" onclick="delCartItem(2)">×</a></td>
                                    </tr>

                                    <tr id="row3">
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <img src="img/AM1.PNG" class="d-block ui-w-40 ui-bordered mr-4" alt="NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'">
                                                <div class="media-body">
                                                    <a href="#" class="d-block text-dark">NIKE AIR MAX 90 PREMIUM 'NEW SPECIES'</a>
                                                    <small>
                                                        <span class="text-muted">Color:</span> PURE PLATINUM & BIO GREEN
                                                        <span class="text-muted">Size: </span> US 10.5 &nbsp;
                                                        <span class="text-muted">Ships from: </span> United States or America
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 185.00</td>
                                        <td class="align-middle p-4"><input type="text" class="form-control text-center" value="1"></td>
                                        <td class="text-right font-weight-semibold align-middle p-4">SGD 185.00</td>
                                        <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove" onclick="delCartItem(3)">×</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->

                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4">
                                <label class="text-muted font-weight-normal">Enter Promo Code Here:</label>
                                <input type="text" placeholder="Promo Code" class="form-control">
                            </div>
                            <div class="d-flex">
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Discount</label>
                                    <div class="text-large"><strong>SGD 0.00</strong></div>
                                </div>
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Shipping Fee</label>
                                    <div class="text-large"><strong>SGD 18.00</strong></div>
                                </div>
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <div class="text-large"><strong>SGD 679</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="button" class="btn btn-lg btn-secondary md-btn-flat mt-2 mr-3" onclick="goBack()">Back to shopping</button>
                            <button type="button" class="btn btn-lg btn-secondary mt-2">Checkout</button>
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