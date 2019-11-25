<?php
if (!isset($_POST['register_submit'])) {
    header('Location: ../index.php?404');
}

global $first_name, $last_name, $email, $hash, $errorMsg, $success;
// Create connection
$conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);

    $email = $_POST["email"];
    $check = "SELECT * FROM p5_2.zenith_members WHERE email='$email'";
    $dupcheck = mysqli_query($conn, $check);
    // to check if this email have been registered before
    if (mysqli_num_rows($dupcheck) > 0) {
        header("Location: ../register.php?emailexist");
    } else {
        $email = sanitize_input($_POST["email"]);
        //hashing of password and checking if both password matches
        $password = sanitize_input($_POST["password"]);
        if ($_POST["password"] != $_POST["confirm_password"]) {
            header("Location: ../register.php?pwnotmatch");
        } else {
            
            $sql = "INSERT INTO p5_2.zenith_members (fname, lname, email, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            // Execute the query
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $hash);
            mysqli_stmt_execute($stmt);
            $flag = 1;
            $checkd = "SELECT * FROM p5_2.zenith_members WHERE email='$email'";
            $data = $conn->query($checkd);
            if ($data->num_rows > 0){
                $row = $data->fetch_assoc();
                $mID = $row["zmember_id"];
                $main = "z25";
                $promocode = $main."".random_str(5);
                while ($flag == 1) {
                    $code = "SELECT zmember_id FROM p5_2.zpromo_code WHERE promocode='$promocode'";
                    $dup = $conn->query($code);
                    if ($dup->num_rows > 0){
                        $promocode = $main."".random_str(5);
                        $flag = 1;
                    } else {
                        $in = "INSERT INTO p5_2.zpromo_code (promocode, zmember_id) VALUES ('$promocode', '$mID')";
                        if (!$conn->query($in)) {
                            $errorMsg = "Database error: " . $conn->error;
                            $success = false;
                        }
                        $flag = 0;
                    }
                }
                header("Location: ../login.php?successful");
            }
        }
    } 
}

// Free up stored result memory for the given statement handle.
mysqli_stmt_free_result($stmt);
$conn->close();

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces [] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
