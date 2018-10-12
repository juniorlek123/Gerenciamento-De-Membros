<?php

    session_start();
    include('conexao.php');

    $id=$_POST['id'];
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $telefone=$_POST['tel'];

    $sql = ("UPDATE tbmembros SET nome= ?, email= ?, telefone= ? WHERE id= ?");

    $stmtCad = $con->prepare($sql);
    $stmtCad->bindParam(1, $nome);
    $stmtCad->bindParam(2, $email);
    $stmtCad->bindParam(3, $telefone);
    $stmtCad->bindParam(4, $id); 

    $stmtCad->execute();

    echo "<script>alert('Dados atualizados com sucesso !!!');location.href=\"index.php\";</script>";
    
?>


