<html lang="en">
    <head>
        <title>Zenith - Edit Profile</title>
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
    <script>
        var namepatt = /^[a-z-][a-z][a-z]+$/i;
        var emailpatt = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        function validateForm() {
            var x = document.forms["profForm"]["email"].value;
            if (x == null || x == "") {
                alert("Email must be filled out");
                return false;
            } else if (emailpatt.test(x) == false) {
                alert("Invalid email address");
                return false;
            }
        }
    </script>
    <body>
        <?php
        include 'inc/header.php';
        if (!isset($_SESSION['name'])) {
//            header('Location: index.php');
            echo "<script>window.location.href='index.php'</script>";
        }
        $success = true;

        getMemberInfoPrep();

        function getMemberInfoPrep() {
            global $id, $email, $first_name, $last_name, $dob;
            global $gender, $mobile, $country, $city, $address, $success, $zid;
            global $day, $month, $year;
            $id = $_SESSION['zid'];

            // Create connection
            $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {

                // prepare and bind
                $stmt = $conn->prepare("SELECT * FROM p5_2.zenith_members WHERE zmember_id = ?");
                $stmt->bind_param("s", $id);
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_name = $row["fname"];
                    $last_name = $row["lname"];
                    $email = $row["email"];
                    $gender = $row["gender"];
                    $mobile = $row["mobile"];
                    $country = $row["country"];
                    $city = $row["city"];
                    $address = $row["address"];

                    $dob = $row["dob"];
                    $dob = strtotime($dob); // String to time
                    $day = date('d', $dob);
                    $month = date('m', $dob);
                    $year = date('Y', $dob);
                } else {
                    $success = false;
                }
            }
            $result->free_result();
            $stmt->close();
            $conn->close();
        }
        ?>
        <main>
            <div class="profilepage">
                <div class="row align-items-center my-5">
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-12">
                        <h2 class="mb-4">Edit My Profile</h2>
                        <div id="profbox">
                            <form action="<?php echo htmlspecialchars('inc/editprof_process.php') ?>" onsubmit="return validateForm()" name="profForm"  method="POST">
                                <div class="row">
                                    <div class="col-lg-6"> <!-- Start of Profile Settings-->
                                        <h3 class="mb-4">Profile Settings</h3><hr/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="fname">First Name:</label>
                                            </div>
                                            <div class="col-6">
                                                <label for="lname" class="">Last Name:</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="first_name" pattern="[a-zA-Z]{1,45}" value="<?php echo $first_name ?>">
                                            </div>
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="last_name" pattern="[a-zA-Z]{1,45}" value="<?php echo $last_name ?>" required>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="dob">Date of Birth (DD/MM/YYYY):</label>
                                            </div>
                                            <div class="col-6">
                                                <label for="gender">Gender: </label>
                                            </div>

                                            <div class="col-6">
                                                <select class="form-control-sm" name="dob_d"><option value='<?php echo $day ?>' selected='selected'><?php echo $day ?></option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
                                                <select class="form-control-sm" name="dob_m"><option value='<?php echo $month ?>' selected='selected'><?php echo $month ?></option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>
                                                <select class="form-control-sm" name="dob_y"><option value='<?php echo $year ?>' selected='selected'><?php echo $year ?></option><option value="1919">1919</option><option value="1920">1920</option><option value="1921">1921</option><option value="1922">1922</option><option value="1923">1923</option><option value="1924">1924</option><option value="1925">1925</option><option value="1926">1926</option><option value="1927">1927</option><option value="1928">1928</option><option value="1929">1929</option><option value="1930">1930</option><option value="1931">1931</option><option value="1932">1932</option><option value="1933">1933</option><option value="1934">1934</option><option value="1935">1935</option><option value="1936">1936</option><option value="1937">1937</option><option value="1938">1938</option><option value="1939">1939</option><option value="1940">1940</option><option value="1941">1941</option><option value="1942">1942</option><option value="1943">1943</option><option value="1944">1944</option><option value="1945">1945</option><option value="1946">1946</option><option value="1947">1947</option><option value="1948">1948</option><option value="1949">1949</option><option value="1950">1950</option><option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option></select>
                                            </div>
                                            <div class="col-3">
                                                <div class="genderbox">
                                                    <p align="center">Male</p><input class="form-check-input" id="M" type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? "checked" : ""; ?> required>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="genderbox">
                                                    <p align="center">Female</p><input class="form-check-input" id="F" type="radio" name="gender"value="Female" <?php echo ($gender == 'Female') ? "checked" : ""; ?>>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="email">Email:</label>
                                            </div>
                                            <div class="col-6">
                                                <label for="mobile">Mobile:</label>
                                            </div>

                                            <div class="col-6">
                                                <input class="form-control" type="text" name="email" value="<?php echo $email ?>" required>
                                            </div>
                                            <div class="col-6">
                                                <input class="form-control" type="tel" name="mobile" pattern="[0-9]{8}" value="<?php echo $mobile ?>">
                                            </div>

                                        </div><br/>
                                        <hr/>
                                    </div> <!-- End of Profile Settings-->
                                    <!--######################################################################################################################################################### -->                            
                                    <div class="col-lg-6">
                                        <h3 class="mb-4">Location</h3><hr/>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="country">Country/Region: </label>
                                            </div>
                                            <div class="col-6">
                                                <label for="city">City: </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <?php
                                                $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                                echo "<select id='country' name='country' class='form-control'>";
                                                for ($i = 0; $i < sizeof($countries); $i++) {
                                                    if ($country != "") {
                                                        echo "<option value='$country' selected='selected'>$country</option>";
                                                    }

                                                    echo "<option value=$countries[$i]>$countries[$i]</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>
                                            <div class="col-6">
                                                <input class="form-control" type="text" name="city" id="city" value="<?php echo $city ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="address"> Address: </label>
                                            </div>
                                            <div class="col-12">
                                                <input class="form-control" type="text" name="address" id="address" value="<?php echo $address ?>">
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>
                                </div>
                                <div class="text-align-right">
                                    <button type="submit" class="btn btn-outline-dark" id="cancelBtn" onclick="window.history.go(-1); return false;">Cancel</button>
                                    <button type="submit" class="btn btn-outline-dark" id="saveBtn">Save</button>
                                </div>
                            </form>
                        </div> <!-- End of Registerbox-->


                    </div> <!-- Container for the whole of register-->
                </div>
                <!-- /.col-md-4 -->
            </div>
        </main>
        <?php
        include "inc/footer.php";
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>