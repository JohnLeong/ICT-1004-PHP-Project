<?php

if (!isset($_SESSION)) {
    session_start();
}

function setLogin($first_name, $last_name) {
    $_SESSION['name'] = $first_name . " " . $last_name;
}

function getID($zid) {
    $_SESSION['zid'] = $zid;
}

function endSession() {
    $_SESSION = array();
    session_unset();
    session_destroy();
}
?>