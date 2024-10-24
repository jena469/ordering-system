<?php
    session_start();

    unset($_SESSION['reg_id']);
    unset($_SESSION['customerName']);
    unset($_SESSION['user']);
    unset($_SESSION['addedOrder']);

    echo '<script>window.location="index.php"</script>';
?>