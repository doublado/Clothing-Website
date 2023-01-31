<?php
    session_start();

    require __DIR__ . "/assets/lib/functions.php";

    $type = CleanUserInput($_GET['type']);

    if(!isset($_SESSION['username'])) {
        redirect("index.php");
    }

    $_SESSION = array();

    session_destroy();

    if ($type == "success") {
        redirect("index.php");
    } else if ($type == "error") {
        redirect("index.php");
    } else {
        redirect("index.php");
    }
?>