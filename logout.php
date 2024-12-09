<?php
    session_start();
    $_SESSION['email']=null;
    $_SESSION['full_name']=null;
    session_destroy();
    echo "<script>window.location.href='index.php';</script>";
?>