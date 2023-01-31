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

    # Check if user is logged in.
    function is_loggedin()
    {
        if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
            return true;
        } else {
            $_SESSION['username'] = "";
            $_SESSION['userid'] = "";
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