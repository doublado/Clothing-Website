<?php
    # Enabling error display
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    require __DIR__ . "/assets/lib/crud.php";
    require __DIR__ . "/assets/lib/functions.php";

    // Check if user is logged in
    if (is_loggedin()) {
        redirect("index.php");
    }

    $uuid = uniqid();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $created = date("Y-m-d H:i:s");

    // Check for xss and sql injection attacks
    $username = CleanUserInput($username);
    $password = CleanUserInput($password);
    $confirm_password = CleanUserInput($confirm_password);

    // Create a new user with hashed password

    // Check if username is taken
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Brugernavnet er optaget.";
    } else {
        if ($password != $confirm_password) {
            echo "Kodeordene matcher ikke.";
        } else {
            // Hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (userid, username, password, created_at) VALUES (:uuid, :username, :password, :created)");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':created', $created);
            $stmt->execute();

            echo "Success";
        }
    }
?>