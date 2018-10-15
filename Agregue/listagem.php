<?php

    session_start();

    include('conexao.php');

    $idsessao = $_SESSION['id'];

    $sql = "SELECT * FROM converssa where idacesso = ?";
    $stmtListPost = $con->prepare($sql);

    $stmtListPost->bindParam(1, $idsessao);

    $stmtListPost->execute();

    $lista = $stmtListPost->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($lista);
?>