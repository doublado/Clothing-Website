<?php
    
    # A function to redirect user.
    function redirect($url) 
    {
        if (!headers_sent())
        {    
            header('Location: '.$url);
            exit;
            }
        else
            {  
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>';
            exit;
        }
    }

    # A function which returns users IP
    function client_ip() 
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    # Check user's avatar type
    function is_animated($avatar) 
    {
        $ext = substr($avatar, 0, 2);
        if ($ext == "a_")
        {
            return ".gif";
        }
        else
        {
            return ".png";
        }
    }

    # Initialize every frontend page.
    function InitPage($pdo, $PANEL_URL)
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['username'] = "";
            $_SESSION['uuid'] = "";
        } else {
            if (!isset($_SESSION['access_token'])) {
                redirect($PANEL_URL."/assets/lib/logout?type=error");
            } else {
                // Check if the users is already registered in the database.
                $stmt1 = $pdo->prepare('SELECT * FROM users WHERE userid = "' . $_SESSION['user_id'] . '"');
                $stmt1->execute();

                if ($stmt1->rowCount() == 0) {
                    $creationdate = date("Y-m-d H:i:s");
                    $lastip = client_ip();
                    $uuid = uniqid();
                    $stmt2 = $pdo->prepare('INSERT INTO users (userid, uuid, email, created_at, lastlogin, lastip) VALUES ("' . $_SESSION['user_id'] . '", "' . $uuid . '", "' . $_SESSION['email'] . '", "' . $creationdate . '", "' . $creationdate . '", "' . $lastip . '")');
                    $stmt2->execute();
                } else {
                    $stmt3 = $pdo->prepare('UPDATE users SET lastlogin = "' . date("Y-m-d H:i:s") . '", lastip = "' . client_ip() . '" WHERE userid = "' . $_SESSION['user_id'] . '"');
                    $stmt3->execute();

                    $stmt4 = $pdo->prepare('SELECT * FROM users WHERE userid = "' . $_SESSION['user_id'] . '"');
                    $stmt4->execute();
                    $row = $stmt4->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['uuid'] = $row['uuid'];
                }
            }
        }
    }

    # Check if user is logged in.
    function is_loggedin($PANEL_URL)
    {
        if (isset($_SESSION['user'])) {
            if (!isset($_SESSION['access_token'])) {
                $_SESSION['username'] = "";
                $_SESSION['uuid'] = "";
                redirect($PANEL_URL."/assets/lib/logout?type=error");
                return false;
            } else {
                return true;
            }
        } else {
            $_SESSION['username'] = "";
            $_SESSION['uuid'] = "";
            redirect($PANEL_URL."");
            return false;
        }
    }

    # Clean User Input
    function CleanUserInput($input)
    {
        $input = trim($input);
        $input = htmlspecialchars($input, ENT_QUOTES, "UTF-8");
        $input = strip_tags($input);
        return $input;
    }
?>