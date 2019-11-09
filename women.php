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
                        <?php
                        //Constants for accessing our DB:
                        define("DBHOST", "161.117.122.252");
                        define("DBNAME", "p5_2");
                        define("DBUSER", "p5_2");
                        define("DBPASS", "yzhbGyqP87");
                        
                        $success = true;

                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        // Check connection
                        if ($conn->connect_error) {
                            $errorMsg = "Connection failed: " . $conn->connect_error;
                            $success = false;
                        } else {
                            $sql = "SELECT * FROM p5_2.products WHERE gender='Women'";

                            // Execute the query
                            $result = $conn->query($sql);
                            $num_results = $result->num_rows;
                            $num_rows = $num_results / 3;
                            if ($num_results > 0) {
                                for ($i = 0; $i < $num_rows; $i++) {
                                    echo "<div class =row>";   //Create row
                                    for ($j = 0; $j < 3; $j++) {
                                        if(!($row = $result->fetch_assoc()))
                                                break;
                                        if ($row["gender"] != "Women")
                                            continue;

                                        $colors_result = $conn->query("SELECT * FROM p5_2.product_details WHERE product_ID=" . $row["product_ID"]);
                                        $num_colors = $colors_result->num_rows;
                                        $colors_result->free_result();

                                        echo "<div class='col-md-4'>";
                                        echo "<div class='card h-100'>";   
                                        
                                        echo "<div class='card-body'>";   
                                        echo "<img class='productimgresize fitimage' src='" . $row["image"] . "' alt='". $row["product_name"] . "'/>";
                                        echo "<h3 class='card-title'>" . $row["product_name"] . "</h3>";
                                        echo "<p class='productdescription'>" . $row["type"] . "</p>";
                                        echo "<p class='productoption'>". $num_colors . " Colour(s)</p>";
                                        echo "</div>";

                                        echo "<div class = card-footer>";
                                        echo "<a href = productdetails.html class='btn btn-secondary btn-sm'>More Info</a>";
                                        echo "<a href = https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2019%2F09%2Fair-jordan-first-class-03.jpg?q=90&w=1400&cbr=1&fit=max>Image source</a>";
                                        echo "</div>";

                                        echo "</div>";
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                }
                            } else {
                                $success = false;
                            }
                            $result->free_result();
                        }
                        $conn->close();
                        ?>
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