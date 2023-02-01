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

    $storeid = $_POST['id'];
    $clothingid = uniqid();
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $created = date("Y-m-d H:i:s");

    // Check for xss and sql injection attacks
    $name = CleanUserInput($name);
    $type = CleanUserInput($type);
    $description = CleanUserInput($description);
    $price = CleanUserInput($price);

    // Check if store exists
    $stmt = $pdo->prepare("SELECT * FROM stores WHERE id = :id");
    $stmt->bindParam(':id', $storeid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set $storeid to the storeid of the store
    $storeid = $result['storeid'];

    if ($result) {
        if (!empty($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            $uploadname = uniqid() . "." . $filetype;

            $allowtypes = array('jpg', 'png', 'jpeg');

            if (in_array($filetype, $allowtypes)) {
                $uploadpath = __DIR__ . "/assets/img/clothing/" . $uploadname;
                $upload = move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath);

                if ($upload) {
                    $stmt = $pdo->prepare("INSERT INTO clothing (storeid, title, type, price, description, image, created_at) VALUES (:storeid, :title, :type, :price, :description, :image, :created)");
                    $stmt->bindParam(':storeid', $storeid);
                    $stmt->bindParam(':title', $name);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':image', $uploadname);
                    $stmt->bindParam(':created', $created);
                    $stmt->execute();

                    echo "Success";
                } else {
                    echo "Der skete en fejl under upload af billedet.";
                }
            } else {
                echo "Billedet skal være af typen jpg, png eller jpeg.";
            }
        } else {
            echo "Du skal uploade et billede.";
        }
    } else {
        echo "Butikken eksisterer ikke.";
    }


    // $stmt = $pdo->prepare("SELECT * FROM stores WHERE name = :name");
    // $stmt->bindParam(':name', $name);
    // $stmt->execute();
    // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // if ($result) {
    //     echo "Butikken eksisterer allerede.";
    // } else {
    //     if (!empty($_FILES['image'])) {
    //         $filename = $_FILES['image']['name'];
    //         $filetype = pathinfo($filename, PATHINFO_EXTENSION);
    //         $uploadname = uniqid() . "." . $filetype;

    //         $allowtypes = array('jpg', 'png', 'jpeg');

    //         if (in_array($filetype, $allowtypes)) {
    //             $stmt = $pdo->prepare("INSERT INTO stores (storeid, name, email, description, image, created_at, ownerid) VALUES (:storeid, :name, :email, :description, :image, :created, :ownerid)");
    //             $stmt->bindParam(':storeid', $storeid);
    //             $stmt->bindParam(':name', $name);
    //             $stmt->bindParam(':email', $email);
    //             $stmt->bindParam(':description', $description);
    //             $stmt->bindParam(':image', $uploadname);
    //             $stmt->bindParam(':created', $created);
    //             $stmt->bindParam(':ownerid', $ownerid);
    //             $stmt->execute();

    //             // Save image to the assets/img/stores folder
    //             move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/assets/img/stores/" . $uploadname);

    //             echo "Success";
    //         } else {
    //             echo "Forkert filtype.";
    //         }
    //     } else {
    //         echo "Ingen fil valgt.";
    //     }
    // }
?>