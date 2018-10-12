<?php

session_start();
include('conexao.php');

$idmembro=$_SESSION['id'];
$titulo=$_POST['titulo'];
$tarefa=$_POST['tarefa'];
$situaçao="Pendente";

$sql = 'INSERT INTO tbtarefas (idmembro, titulo, descriçao, situaçao) VALUES(?, ?, ?, ?)';

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $idmembro);
    $stmtLogar->bindParam(2, $titulo);
    $stmtLogar->bindParam(3, $tarefa);
    $stmtLogar->bindParam(4, $situaçao);

    $stmtLogar->execute(); 
    
    echo "<script>alert('Tarefa cadastrada com sucesso');location.href=\"tarefas.php\";</script>";

?>