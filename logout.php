<?php

    session_start();
    $_SESSION['logado'] = '';   
    $_SESSION['tipologin'] = '';
    header("location: index.php");

?>