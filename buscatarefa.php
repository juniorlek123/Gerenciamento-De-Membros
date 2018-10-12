<?php

session_start();

$campo="%".$_POST['campo']."%";
$id="%".$_SESSION['id']."%";

include('conexao.php');
        $sql = "SELECT * FROM tbtarefas where titulo like ? and idmembro like ?";
        $stmtListagem = $con->prepare($sql);
        $stmtListagem->bindParam(1, $campo);
        $stmtListagem->bindParam(2, $id);
        $stmtListagem->execute();
        $listaMembros=$stmtListagem->fetchAll(PDO::FETCH_ASSOC);

        echo '<table class="table table-striped table-hover table-bordered">
        <thead class="table-bordered">
        <tr>
        <td class="fontpag"><strong>Id</strong></td>
        <td class="fontpag"><strong>Titulo</strong></td>
        <td class="fontpag"><strong>Situação</strong></td>
        <td></td>
        </tr>
        </thead>
        <tbody>
        ';
        foreach($listaMembros as $membro){
        echo '<tr>';
        echo '<td class="fontpag">'. $membro['id']. '</td>';
        echo '<td class="fontpag">'. $membro['titulo']. '</td>';
        echo '<td class="fontpag">'. $membro['situaçao']. '</td>';
        echo '<td><button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#editmembro" data-id="'.$membro['id'].'" data-titulo="'.$membro['titulo'].'" data-descriçao="'.$membro['descriçao'].'"> Editar</button><a></a><button class="btn btn-outline-danger my-2 my-sm-0" type="button" id="btnExcMem" data-toggle="modal" data-target="#confexcmembro" data-id="'.$membro['id'].'">Delete</button></td>';
        }
        echo "
        </tbody>
        </table>
        ";
?>