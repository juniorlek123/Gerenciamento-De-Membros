<?php

session_start();
include('conexao.php');

$nome=$_POST['nome'];
$email=$_POST['email'];
$telefone=$_POST['tel'];

$sql = 'INSERT INTO tbmembros (nome, email, telefone) VALUES(?, ?, ?)';

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $nome);
    $stmtLogar->bindParam(2, $email);
    $stmtLogar->bindParam(3, $telefone);

    $stmtLogar->execute(); 
    
    echo "<script>alert('Cadastro realizado com sucesso !!!');location.href=\"index.php\";</script>";

?>