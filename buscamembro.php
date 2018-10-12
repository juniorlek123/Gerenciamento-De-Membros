<?php

$campo="%".$_POST['campo']."%";

include('conexao.php');
        $sql = "SELECT * FROM tbmembros where nome like ?";
        $stmtListagem = $con->prepare($sql);
        $stmtListagem->bindParam(1, $campo);
        $stmtListagem->execute();
        $listaMembros=$stmtListagem->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="table table-striped table-hover table-bordered">
<thead class="table-bordered">
<tr>
<td class="fontpag"><strong>Id</strong></td>
<td class="fontpag"><strong>Nome</strong></td>
<td class="fontpag"><strong>Email</strong></td>
<td class="fontpag"><strong>Telefone</strong></td>
<td></td>
</tr>
</thead>
<tbody>
';
foreach($listaMembros as $membro){
    echo '<tr>';
    echo '<td class="fontpag">'. $membro['id']. '</td>';
    echo '<td class="fontpag">'. $membro['nome']. '</td>';
    echo '<td class="fontpag">'. $membro['email']. '</td>';
    echo '<td class="fontpag">'. $membro['telefone']. '</td>';
    echo '<td><button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#editmembro" data-id="'.$membro['id'].'" data-nome="'.$membro['nome'].'" data-email="'.$membro['email'].'"  data-telefone="'.$membro['telefone'].'" data-comentarios="'.$membro['comentarios'].'"> Abrir</button><a></a><button class="btn btn-outline-danger my-2 my-sm-0" type="button" id="btnExcMem" data-toggle="modal" data-target="#confexcmembro" data-id="'.$membro['id'].'">Deletar</button><a href="tarefasmembro.php?id=' .$membro['id'].'"><button class="btn btn-outline-warning my-2 my-sm-0" type="button">Tarefas</button></a></td>';
}
echo "
</tbody>
</table>
";
?>
