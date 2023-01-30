<?php
    require __DIR__ . "/functions.php";
    require __DIR__ . "/settings.php";
    $type = htmlspecialchars($_GET['type']);

    session_start();

    if(!isset($_SESSION['user'])) {
        redirect($panel_url."");
    }

    $_SESSION = array();

    session_destroy();

    if ($type == "success") {
        redirect(PANEL_URL."?type=logout");
    } else if ($type == "error") {
        redirect(PANEL_URL."?type=error");
    }
?>