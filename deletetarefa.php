
<?php

session_start();
include('conexao.php');

    
$iddelete=$_POST['id'];

$sql = 'DELETE FROM tbtarefas WHERE id = ?';
$stmtCad = $con->prepare($sql);
$stmtCad->bindParam(1, $iddelete);

$stmtCad->execute();

header("location: tarefas.php");

?>