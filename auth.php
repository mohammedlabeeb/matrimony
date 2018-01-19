<?php

    if(!isset($_SESSION['user_name']) || (trim($_SESSION['user_id']) == '')) {
            header("location: login.php");
            exit();
    }
?>