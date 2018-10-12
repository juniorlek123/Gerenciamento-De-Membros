<?php

session_start();
include('conexao.php');

$nome=$_POST['nome'];
$email=$_POST['email'];
$telefone=$_POST['tel'];
$comentarios=$_POST['comentarios'];

$sql = 'INSERT INTO tbmembros (nome, email, telefone, comentarios) VALUES(?, ?, ?, ?)';

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $nome);
    $stmtLogar->bindParam(2, $email);
    $stmtLogar->bindParam(3, $telefone);
    $stmtLogar->bindParam(4, $comentarios);

    $stmtLogar->execute(); 
    
    echo "<script>alert('Cadastro realizado com sucesso !!!');location.href=\"inicio.php\";</script>";

?>