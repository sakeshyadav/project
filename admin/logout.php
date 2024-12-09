<?php
    session_start();
    $_SESSION['email']=null;
    session_destroy();
    echo "<script>window.location.href='displaydata.php';</script>";
?>