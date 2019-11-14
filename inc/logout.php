<?php
include_once("session.php");
if (isset($_GET['inactive'])){
    header("Location: ../index.php?inactive");
} else {
    endSession();
    header("Location: ../index.php");
}
?>