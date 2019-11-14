<?php

//Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p5_2");
define("DBUSER", "p5_2");
define("DBPASS", "yzhbGyqP87");

$email = $errorMsg = "";
$success = true;
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]); // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}

if ($success) {
    echo "<br>";
    echo "<h4>You have been added to the mailing list</h4>";
    echo "<a href='index.php'>Back to shopping</a>";
    echo "<br>";
    echo "<br>";
    saveMailingListToDB();
} else {
    header("Location: ../index.php?mailing_error");
}

function saveMailingListToDB() {
    global $name, $email, $message, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        header("Location: ../index.php?mailing_error");
    } else {
        $sql = "INSERT INTO p5_2.mailing_list (email)";
        $sql .= " VALUES('$email')";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
            header("Location: ../index.php?mailing_error");
        } else {
            $errorMsg .= "Successfully added to database";
            header("Location: ../index.php?mailing_success");
        }
    }
    $conn->close();
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>