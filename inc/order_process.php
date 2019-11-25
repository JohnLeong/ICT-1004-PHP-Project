<?php
if (!isset($_POST['ordrec'])) {
    header('Location: ../index.php?404');
} else {
    $conn = new mysqli("161.117.122.252", "p5_2", "yzhbGyqP87", "p5_2");
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $orderid = $_POST['orderid'];
        date_default_timezone_set('Asia/Singapore');
        $date = date("M,d,Y h:i:s A");
        $sql = "UPDATE p5_2.zorder SET status='Received', receive_date='$date' WHERE order_id='$orderid'";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            header('Location: ../orderhistory.php?dbfail');
        }
        
        header('Location: ../orderhistory.php?success');
    }
}