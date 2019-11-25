<?php
if (!isset($_POST['submitContact'])) {
    header('Location: ../index.php?404');
} 

//Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p5_2");
define("DBUSER", "p5_2");
define("DBPASS", "yzhbGyqP87");

$name = $email = $errorMsg = "";
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

$name = sanitize_input($_POST["name"]);

if (empty($_POST["message"])) {
    $errorMsg .= "A message is required.<br>";
    $success = false;
} else {
    $message = sanitize_input($_POST["message"]);
}

if ($success) {
    echo "<br>";
    echo "<h4>Your message has been submitted!</h4>";
    echo "<a href='index.php'>Back to shopping</a>";
    echo "<br>";
    echo "<br>";
    saveMessageToDB();
} else {
    header("Location: ../contactus.php?error");   
}//Helper function that checks input for malicious or unwanted content.

function saveMessageToDB() {
    global $name, $email, $message, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        header("Location: ../contactus.php?error");   
    } else {
        $sql = $conn->prepare("INSERT INTO p5_2.contact_us_info (email, name, message) VALUES(?,?,?)");
        $sql->bind_param("sss", $email, $name, $message);

        // Execute the query
        if (!$sql->execute()) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
            header("Location: ../contactus.php?error");   
        } else {
            $errorMsg .= "Successfully added to database";
            header("Location: ../contactus.php?successful");
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