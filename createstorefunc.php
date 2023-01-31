<?php
    # Enabling error display
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    require __DIR__ . "/assets/lib/crud.php";
    require __DIR__ . "/assets/lib/functions.php";

    // Check if user is logged in
    if (!is_loggedin()) {
		redirect("login.php");
	}

    $storeid = uniqid();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $created = date("Y-m-d H:i:s");

    // Check for xss and sql injection attacks
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $description = htmlspecialchars($description);

    // Create store

    // Check if name is taken
    $stmt = $pdo->prepare("SELECT * FROM stores WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Butikken eksisterer allerede.";
    } else {
        if (!empty($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            $uploadname = uniqid() . "." . $filetype;

            $allowtypes = array('jpg', 'png', 'jpeg');

            if (in_array($filetype, $allowtypes)) {
                $stmt = $pdo->prepare("INSERT INTO stores (storeid, name, email, description, image, created_at) VALUES (:storeid, :name, :email, :description, :image, :created)");
                $stmt->bindParam(':storeid', $storeid);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $uploadname);
                $stmt->bindParam(':created', $created);
                $stmt->execute();

                // Save image to the assets/img/stores folder
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/assets/img/stores/" . $uploadname);

                echo "Success";
            } else {
                echo "Forkert filtype.";
            }
        } else {
            echo "Ingen fil valgt.";
        }
    }
?>