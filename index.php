<html>
<head>
    <?php
        session_start();

        if (isSet($_SESSION['logado'])){
            
        if($_SESSION['logado'] == 'S')
            {
                if (isSet($_SESSION['tipologin'])){

                    if ($_SESSION['tipologin'] == 'ADM'){

                        header("location: inicio.php");

                      }
              
                }
            }
        }


    ?>
    <title>Gerênciador de Membros</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="estilo/index.css">
    <link rel="shortcut icon" href="img/icon1.png" type="image/x-png">
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid">
        <centeR>
            <h3 class="fontpag"><img src="img/icon1.png"> Gerênciador de Membros</h3>
        </centeR>
        <hr>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form class="Logar" name="singnup" method="post" action="verificalogin.php">
                    <center><h3 class="fontpag">Login no Sistema</h3></center>
                    <hr>
                    <div class="fontpag">
                        <label class="fontpag">Usuário</label>
                        <input class="txtForm" type="text" name="usuario" placeholder="" required="">
                    </div>
                    <br>
                    <div class="logar-input">
                        <label class="fontpag">Senha</label>
                        <input class="txtForm" type="password" name="senha" placeholder="" required="">
                    </div>
                    <br>
                    <hr>
                    <div class="Login">
                        <input class="btn btn-outline-info my-2 my-sm-0" type="submit" id="btnEntrar" name="" value="Entrar">
                        <hr>
                    <a href="#"><button class="btn btn-outline-warning my-2 my-sm-0" id="btnRecSenha"  type="button" data-toggle="modal" data-target="#recsenha">Esqueci Minha Senha</button></a>
                    </div>
                    <br>
                    <?php
                       if (isSet($_SESSION['msgERRO'])){
            
                        if($_SESSION['msgERRO'] == "")
                        {
                           
                        }
                        else{
                          echo $_SESSION['msgERRO'];
                        }
                
                      }
                        ?>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
         <footer class="rodape">
            <center><h5 class="fontpag">© 2018</h5></center>
        </footer>
    </div>
    <!-- Tela de Recuperação de Senha -->
    <div class="modal fade" id="recsenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><label class="fontpag">Recuperação de Senha</label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="cadmembro.php">
                    <label class="fontpag">Email</label>
                    <input class="txtForm" type="email" name="email" required>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" id="btnContato">Cancelar</button>
                      <button type="submit" class="btn btn-outline-success my-2 my-sm-0" id="btnContato">Cadastrar</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>