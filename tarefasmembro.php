<?php

session_start();
include('conexao.php');

$idmembro=$_GET['id'];

$sql = "SELECT * FROM tbmembros WHERE id = ?";
        $stmtBuscar = $con->prepare($sql);
        $stmtBuscar->bindParam(1, $idmembro);
       
        $stmtBuscar->execute();

        $membro =  $stmtBuscar->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id']= ($membro['id']);
        $_SESSION['nome']= ($membro['nome']);
        $_SESSION['email']= ($membro['email']);
        $_SESSION['telefone']= ($membro['telefone']);

        header("location: tarefas.php");

?>