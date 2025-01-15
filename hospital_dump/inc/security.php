<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {
    header('Location: ../index.php');
    
}

?>