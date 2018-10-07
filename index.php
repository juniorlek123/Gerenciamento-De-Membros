<html>
    <head>
    <?php
        session_start();
        ?>
        <title>Gerenciamento de Membros</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="estilo/index.css">
        <link rel="shortcut icon" href="img/icon1.png" type="image/x-png">
        <meta charset="utf-8">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#"><img src="img/icon1.png">Gerenciamento de Membros |</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <button class="btn btn-outline-info my-2 my-sm-0" type="submit"><img src="img/icon2.png"> Sair</button>
            </form>
          </div>
        </nav>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="fontpag">Pesquisa</h5>
                    <form class="frmpesquisa">
                        <label class="fontpag"><strong>Nome</strong></label>
                        <input type="text" class="txtPesquisa">
                        <button type="button" class="btn btn-outline-info my-2 my-sm-0" id="btnBuscar"><img src="img/icon4.png">Buscar</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="fontpag">Opções</h5>
                    <form class="frmprincipal">
                        <button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#novoUser"><img src="img/icon3.png"> Novo Membro</button>
                        <!--<button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#novoUser"><img src="img/icon5.png"> Todos os Membros</button>-->
                        <hr>
                        <h5 class="fontpag">Membros Cadastrados</h5>
                        <div class="headertable">
                        </div>
                        <div class="limitetabela">
                            <table class="table" id="tbmembros">
                                <thead>
                                <tr>
                                    <th class="fontpag">Id</th>
                                    <th class="fontpag">Nome</th>
                                    <th class="fontpag">Telefone</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    include('conexao.php');
                                    $sql = "SELECT * FROM tbmembros";
                                    $stmtListagem = $con->prepare($sql);
                                    $stmtListagem->bindParam(1, $_SESSION['id']);
                                    $stmtListagem->execute();
                                    $listaUsuarios=$stmtListagem->fetchAll(PDO::FETCH_ASSOC);
                                    
                                foreach($listaUsuarios as $usuario)
                                {
                                    echo '<tr>';
                                    echo '<td>'. $usuario['id']. '</td>';
                                    echo '<td>'. $usuario['nome']. '</td>';
                                    echo '<td>'. $usuario['telefone']. '</td>';
                                    echo '<td><button class="btn btn-outline-info my-2 my-sm-0" type="button" data-toggle="modal" data-target="#editmembro" data-id="'.$usuario['id'].'" data-nome="'.$usuario['nome'].'" data-email="'.$usuario['email'].'"  data-telefone="'.$usuario['telefone'].'"> Editar</button><a href="deletemembro.php?id=' .$usuario['id'].'"><button class="btn btn-outline-danger my-2 my-sm-0" type="button" id="btnExcMem">Delete</button></a><button type="button" data-toggle="modal" data-target="#confexcmembro"></button></td>';
                                }
                                ?>
                                </tr>
                                </tbody>
                            </table>
                          </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h5 class="fontpag">Resultado Pesquisa</h5>
                    <form class="frmprincipal">
                        <table class="table">
                              <label></label>
                          </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- Novo Usuário -->
        <div class="modal fade" id="novoUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cadastrar novo membro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadmembro.php">
                      <label class="lblText">Nome</label>
                      <input class="newmember" type="text" name="nome" required>
                      <label class="lblText">Email</label>
                      <input class="newmember" type="email" name="email" required>
                      <label class="lblText">Telefone</label>
                      <input class="newmember" type="tel" name="tel" required>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar cadastro do membro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadmembro.php">
                      <label class="lblText">Nome</label>
                      <input class="newmember" type="text" name="nome" id="txtNome" required>
                      <label class="lblText">Email</label>
                      <input class="newmember" type="email" name="email" id="txtEmail" required>
                      <label class="lblText">Telefone</label>
                      <input class="newmember" type="tel" name="tel" id="txtTel" required>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar cadastro do membro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadmembro.php">
                      <label class="lblText">Confirma a exclusão deste membro ?</label>
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
        <script type="text/javascript">
        $('#editmembro').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var id = button.data('id') // Extract info from data-* attributes
          var nome = button.data('nome')
          var email = button.data('email')
          var telefone = button.data('telefone')
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('#id').val(id)
          modal.find('#txtNome').val(nome)
          modal.find('#txtEmail').val(email)
          modal.find('#txtTel').val(telefone)
        })
        </script>
    </body>
</html>