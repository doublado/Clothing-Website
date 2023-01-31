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

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for xss and sql injection attacks
    $username = CleanUserInput($username);
    $password = CleanUserInput($password);

    // Check if username exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Check if password is correct
        if (password_verify($password, $result['password'])) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $result['userid'];

            echo "Success";
        } else {
            echo "Forkert kodeord.";
        }
    } else {
        echo "Brugernavnet findes ikke.";
    }
?>