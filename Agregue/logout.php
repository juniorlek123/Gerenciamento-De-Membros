<?php

    session_start();
    $_SESSION['nome']= '';
    $_SESSION['email']= '';
    $_SESSION['tel']= '';
    $_SESSION['id']= '';
    $_SESSION['primeira']= '';
    $_SESSION['horario']= '';
    $_SESSION['idagen']= '';
    $_SESSION['sair'] = '';
    $_SESSION['iniciado'] = 'encerrado';
    header("location: fim.php");

?>