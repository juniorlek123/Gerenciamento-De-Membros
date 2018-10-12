<!DOCTYPE html>
<html>
  <head>
    <?php
      session_start();

      if (isSet($_SESSION['logado'])){
            
        if($_SESSION['logado'] != 'S')
        {
          $_SESSION['msgERRO'] = "";
          header("location: index.php");
        }
      }

    ?>
      <title>Gerenciador de Membros</title>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="estilo/inicio.css">
      <link rel="shortcut icon" href="img/icon1.png" type="image/x-png">
      <meta charset="utf-8">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="img/icon1.png">Gerenciador de Membros |</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <button class="btn btn-outline-info my-2 my-sm-0" type="button"><img src="img/icon2.png" data-toggle="modal" data-target="#conflogout">> Sair</button>
            </form>
          </div>
        </nav>
        <hr> 
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h5 class="fontpag">Pesquisa</h5>
                <form class="frmpesquisa" id="frm">
                  <label class="fontpag"><strong>Nome</strong></label>
                    <input type="text" class="txtPesquisa" name="campo" id="campo">
                </form>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h5 class="fontpag">Opções de Membros</h5>
                <form class="frmprincipal">
                  <button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#novoUser"><img src="img/icon3.png"> Novo Membro</button>
                    <hr>
                     <h5 class="fontpag">Membros Cadastrados</h5>
                        <div class="limitetabela">
                          <div id="resultado">
                            <?php
                            include('conexao.php');
                            $sql = "SELECT * FROM tbmembros";
                            $stmtListagem = $con->prepare($sql);
                            $stmtListagem->bindParam(1, $_SESSION['id']);
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
                          </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Novo Usuário -->
        <div class="modal fade" id="novoUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Cadastrar novo membro</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadmembro.php">
                    <label class="fontpag">Nome</label>
                    <input class="txtForm" type="text" name="nome">
                    <label class="fontpag">Email</label>
                    <input class="txtForm" type="email" name="email">
                    <label class="fontpag">Telefone</label>
                    <input class="txtForm" type="tel" name="tel">
                    <label class="fontpag">Comentários</label>
                    <textarea class="txtTarefa" type="text" name="comentarios" id="txtComentarios"></textarea>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Cancelar</button>
                      <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Cadastrar</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Editar dados do Membro -->
        <div class="modal fade" id="editmembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Editar cadastro do membro</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="editmembro.php">
                    <label class="fontpag">Nome</label>
                    <input class="txtForm" type="text" name="nome" id="txtNome">
                    <label class="fontpag">Email</label>
                    <input class="txtForm" type="email" name="email" id="txtEmail">
                    <label class="fontpag">Telefone</label>
                    <input class="txtForm" type="tel" name="tel" id="txtTel">
                    <label class="fontpag">Comentários</label>
                    <textarea class="txtTarefa" type="text" name="descriçao" id="txtComentarios"></textarea>
                    <input type="hidden" class="txtId" name="id" id="id">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Cancelar</button>
                      <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Alterar</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Confirma exclusão de membro -->
        <div class="modal fade" id="confexcmembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Excluir Membro</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="post" action="deletemembro.php">
                    <label class="fontpag">Confirma a exclusão deste membro ?</label>
                    <input type="hidden" class="txtId" name="id" id="id">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Não</button>
                      <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Sim</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Confirma Logout -->
        <div class="modal fade" id="conflogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Sair do sistema</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="post" action="deletemembro.php">
                    <label class="fontpag">Deseja realmente deslogar do sistema ?</label>
                    <input type="hidden" class="txtId" name="id" id="id">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Não</button>
                    <a href="logout.php"><button type="button" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Sim</button></a>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/buscamembro.js"></script>
        <script type="text/javascript" src="js/carregamembro.js"></script>
    </body>
</html>