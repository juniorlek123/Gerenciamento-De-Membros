<?php

    session_start();
    include('conexao.php');

    $id=$_POST['id'];
    $titulo=$_POST['titulo'];
    $descriçao=$_POST['descriçao'];

    $sql = ("UPDATE tbtarefas SET titulo = ?, descriçao = ? WHERE id= ?");

    $stmtCad = $con->prepare($sql);
    $stmtCad->bindParam(1, $titulo);
    $stmtCad->bindParam(2, $descriçao);
    $stmtCad->bindParam(3, $id); 

    $stmtCad->execute();

   echo "<script>alert('Dados atualizados com sucesso !!!');location.href=\"tarefas.php\";</script>";
    
?>
