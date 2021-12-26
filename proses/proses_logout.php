<?php
    session_start();
    session_destroy();
    if (!empty($_SESSION['username'])) { //$_session username untuk melindungi username
        echo "<script> window.location='../sign-in/index.php'; </script>";
    } elseif (empty($_SESSION['username'])) { //$_session username untuk melindungi username
            echo "<script> window.location='../sign-in/index.php'; </script>";
        }
?>