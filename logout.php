<?php
    session_start();

    unset($_SESSION['admin_id']);
    unset($_SESSION['name']);
    unset($_SESSION['admin']);
    unset($_SESSION['gender']);
    echo '<script>window.location="loginAdmin.php"</script>';
?>