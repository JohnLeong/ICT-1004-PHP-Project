<?php

if (!isset($_POST['login_submit'])) {
    header('Location: ../index.php');
} else {
    // Create connection
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
    } else {
        // Sanitizing to prevent SQL injections
        $email = sanitize_input($_POST["email"]);
        $cemail = mysqli_real_escape_string($conn, $email);
        $pwd = sanitize_input($_POST["password"]);
        $cpwd = mysqli_real_escape_string($conn, $pwd);
            
        // Execute the query
        $sql = "SELECT * FROM p5_2.zenith_members WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $dbPw = $row["password"];
            $first_name = $row["fname"];
            $last_name = $row["lname"];
            $zid = $row["zmember_id"];
            if (password_verify($cpwd, $dbPw)) {
                include_once("session.php");
                setLogin($first_name, $last_name);
                getID($zid);
                header("Location: ../index.php");
            }
            else{//wrong password
                header("Location: ../login.php?error");          
            }
        }else{//wrong email
            header("Location: ../login.php?error");
        }
    }
    $conn->close();
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>