<?php

    session_start();
    include('conexao.php');

        
    $iddelete=$_GET['id'];

    $sql = 'DELETE FROM tbmembros WHERE id = ?';
    $stmtCad = $con->prepare($sql);
    $stmtCad->bindParam(1, $iddelete);

    $stmtCad->execute();

    header("location: index.php");
    
?>