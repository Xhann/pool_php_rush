<?php
    session_start();
    session_unset();
    unset($_SESSION);
    $_session=[];
    $_SESSION['id']="";
    $_SESSION['mail']="";
    $_SESSION['password']="";
    $_SESSION['admin']="";
    $_SESSION['new']="";
    $_SESSION['ErrorMsg']="";
    $_SESSION['username']="";
    session_destroy();
    //Pour être sur que c'est bien détruit vu la galère !!
    header('location:login.php');
