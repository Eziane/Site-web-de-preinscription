<?php
    session_start();
    // session_unset();
    // session_destroy();
    $_SESSION['id_admin']=null;
    header('location:index.php');
?>