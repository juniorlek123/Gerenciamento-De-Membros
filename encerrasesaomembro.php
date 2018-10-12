<?php

    session_start();
    $_SESSION['id']= '';
    $_SESSION['nome']= '';
    $_SESSION['email']= '';
    $_SESSION['telefone']= '';

    header("location: index.php");

?>