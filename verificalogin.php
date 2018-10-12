<?php

    session_start();
    include("conexao.php");

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario =='admin' and $senha == 'admin'){
        
         $_SESSION['logado']= "S";
         $_SESSION['msgERRO'] = "";
         $_SESSION['tipologin'] = "ADM";
         header("location: inicio.php");
        
    }

    else{
        
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email ou senha incorretos<center><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></center></div>';
        
        $_SESSION['msgERRO']= $msg;
    
        
        header("location: index.php");
        
        
    }



?>