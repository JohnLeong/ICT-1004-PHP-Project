<?php
//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['register_submit'])) {
    
    // Constants for accessing our DB:
    define("DBHOST", "localhost");
    define("DBNAME", "zenith");
    define("DBUSER", "root");
    define("DBPASS", "");

    // Connecting to the DB
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Checking connection to DB
    if (!$conn) {
        die("Conntection failed: ".mysqli_connect_error());
    }
    
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);
    $confirm_password = sanitize_input($_POST["confirm_password"]);
    
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=emptyfields&first_name=".$first_name."&last_name=".$last_name."&email=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&first_name=".$first_name."&last_name=".$last_name);
        exit();
    }
    else if ($password !== $confirm_password) {
        header("Location: ../register.php?error=invalidmail&first_name=".$first_name."&last_name=".$last_name."&email=".$email);
        exit();
    }
    else {
        $sql = "SELECT email FROM zenith_member WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bing_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows();
            if ($result > 0) {
                header("Location: ../register.php?error=emailtaken&first_name=".$first_name."&last_name=".$last_name);
                exit();
            }
            else {
                $sql = "INSERT INTO zenith_member (fname, lname, email, password) "
                        . "VALUE (?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bing_param($stmt, "ssss", $first_name, $last_name, $email, $hashPwd);
                    mysqli_stmt_execute($stmt);
                }
            }
        }      
    } 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
    <main>
        <div class ="container-fluid register">
            <form method="post">
                <div class="form-group">
                    <?php
                    echo "<h2>Your registration is successful!</h2>";
                    echo "<h4>Thanks for signing up " . $first_name . ".</h4>";
                    ?>
                    <input class="btn btn-default" type="button" value="Login" 
                           onclick="window.location.href='login.php'" />
                    <input class="btn btn-default" type="button" value="Home" 
                           onclick="window.location.href='index.php'" />
                </div>
            </form>
        </div>
    </main>
<?php
}
else {
    header("Location: ../register.php");
    exit();
}

?>