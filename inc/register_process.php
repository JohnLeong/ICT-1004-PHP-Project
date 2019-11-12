<?php

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

    $email = sanitize_input($_POST["email"]);
    $check = "SELECT * FROM p5_2.zenith_members WHERE email='$email'";
    $dupcheck = $conn->query($check);
    // to check if this email have been registered before
    if ($dupcheck->num_rows > 0) {
        $data = $dupcheck->fetch_assoc();
        header("Location: ../register.php?emailexist");
    } else {
        //hashing of password and checking if both password matches
        $password = sanitize_input($_POST["password"]);
        if ($_POST["password"] != $_POST["confirm_password"]) {
            header("Location: ../register.php?pwnotmatch");
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO p5_2.zenith_members (fname, lname, email, password)";
            $sql .= " VALUES ('$first_name', '$last_name', '$email', '$hash')";
            // Execute the query
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            header("Location: ../login.php?successful");
        }
    }
}$conn->close();

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
