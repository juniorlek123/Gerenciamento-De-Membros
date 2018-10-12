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
      <title><?php echo $_SESSION['nome'];?></title>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="estilo/tarefas.css">
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
              <a href="inicio.php"><button class="btn btn-outline-info my-2 my-sm-0" type="button"><img src="img/icon6.png"> Voltar</button></a>
            </form>
          </div>
        </nav>
        <hr> 
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h5 class="fontpag">Dados do Membro</h5>
                <form class="frmpesquisa" id="frm">
                <label class="fontpag"><strong>Id:</strong></label>
                  <label class="fontpag"><?php echo $_SESSION['id'];?></label><br>
                  <label class="fontpag"><strong>Nome:</strong></label>
                  <label class="fontpag"><?php echo $_SESSION['nome'];?></label><br>
                  <label class="fontpag"><strong>Email:</strong></label>
                  <label class="fontpag"><?php echo $_SESSION['email'];?></label><br>
                  <label class="fontpag"><strong>Telefone:</strong></label>
                  <label class="fontpag"><?php echo $_SESSION['telefone'];?></label><br>
                  <hr>
                  <label class="fontpag">Buscar Tarefa</label>
                  <input class="buscatarefa" type="text" name="campo" id="campo">
                  <br>
                  <br>
                </form>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-12">
              <h5 class="fontpag">Tarefas Atribuidas ao Membro</h5>
                <form class="frmprincipal">
                  <button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#novoUser"><img src="img/icon7.png"> Nova Tarefa</button>
                    <br>
                    <br>
                        <div class="limitetabela">
                          <div id="buscatarefa">
                            <?php
                            include('conexao.php');
                            $sql = "SELECT * FROM tbtarefas where idmembro = ?";
                            $stmtListagem = $con->prepare($sql);
                            $stmtListagem->bindParam(1, $_SESSION['id']);
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
                          </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Nova Tarefa -->
        <div class="modal fade" id="novoUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Cadastrar nova tarefa</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadtarefa.php">
                    <label class="fontpag">Titulo</label>
                    <input class="txtForm" type="text" name="titulo" id="txtNome" required>
                    <label class="fontpag">Descrição</label>
                    <textarea class="txtTarefa" type="text" name="tarefa" required></textarea>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Cancelar</button>
                      <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Cadastrar</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Editar dados da tarefa -->
        <div class="modal fade" id="editmembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Editar tarefa</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="edittarefa.php">
                  <label class="fontpag">Titulo</label>
                    <input class="txtForm" type="text" name="titulo" id="txtTitulo" required>
                    <label class="fontpag">Descrição</label>
                    <textarea class="txtTarefa" type="text" name="descriçao" id="txtDescriçao" required></textarea>
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
        <!-- Confirma exclusão da tarefa -->
        <div class="modal fade" id="confexcmembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Excluir Tarefa</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="post" action="deletetarefa.php">
                    <label class="fontpag">Confirma a exclusão desta tarefa ?</label>
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
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/buscatarefa.js"></script>
        <script type="text/javascript" src="js/carregatarefa.js"></script>
    </body>
</html>