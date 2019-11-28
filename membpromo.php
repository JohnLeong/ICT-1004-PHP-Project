<?php
include 'inc/header.php';
if (!isset($_SESSION['name'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Zenith - Profile</title>
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
        $success = true;

        function getPromo() {
            global $id, $promoCodeArr, $success;
            $promocodeArr = array();
            $id = $_SESSION['zid'];

            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {

                // prepare and bind
                $stmt = $conn->prepare("SELECT * FROM p5_2.zpromo_code WHERE zmember_id = ?");
                $stmt->bind_param("s", $id);
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result != null) {
                    $numOfReviews = $result->num_rows;

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < $numOfReviews; $i++) {
                            $row = $result->fetch_assoc();
                            $promoCodeArr[$i] = $row["promocode"];
                        }
                    } else {
                        $success = false;
                    }
                }
                $result->free_result();
                $stmt->close();
                $conn->close();
            }
        }
        ?>
        <main>
            <div class="profilepage">
                <h2>Promo Code</h2>
                <div class="row align-items-center my-5">
                    <div class="container">
                        <?php
                        getPromo();
                        if ($success == false) {
                            echo "<h3> -- No Promo Code Found -- </h3>";
                        } else {
                            ?>
                            <table width="100%">
                                <tr>
                                    <th>S/N</th>
                                    <th>Promo Code</th>
                                </tr>                            
                                <?php
                                for ($i = 0; $i < sizeof($promoCodeArr); $i++) {
                                    $j = $i + 1;
                                    echo "<tr>";
                                    echo "<td>" . $j . "</td>";
                                    echo "<td>$promoCodeArr[$i]</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        <?php } ?>
                        <div class="text-align-right">
                            <button type="submit" onclick="window.history.go(-1); return false;" class="btn btn-outline-dark" id="editBtn">Back</button>
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
