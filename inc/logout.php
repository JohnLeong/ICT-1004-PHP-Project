<?php
include_once("session.php");

if (isset($_GET['inactive'])){
    header("Location: ../index.php?inactive");
} else {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}
?>