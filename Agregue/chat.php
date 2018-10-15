<!doctype html>
<html lang="PT-BR">
<html>
<head>
    <?php
        session_start();
        if($_SESSION['iniciado'] != 'iniciado')
                {
                    header("location: index.php");
                }
        if($_SESSION['sair'] == 'sim'){
           header("refresh: 10;logout.php"); 
        }
     ?>
    <title>ChatBô - Agregue</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="estilo/chat.css">
    <link rel="shortcut icon" href="imgchat/iconePagina.png" type="image/x-png">
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid">
        <centeR>
            <h1 class="loginTitulo" id="logo"><img src="imgindex/img3.png"> Agregue, Cuidando da sua Saúde</h1>
        </centeR>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="chatbox">
                    <div class="chatlogs" id="chatlogs">
                        
                    </div>
                    <form class="singnup" method="post" id="cadmsg">
                    <div class="chat-form">
                        <textarea name="mensagem" id="msg" autofocus></textarea>
                        <button class="btn enviar" id="enviar" type="submit">Enviar</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>
         <footer class="rodape">
            <center><h5 class="loginTitulo">© 2018 - Desenvolvido por José Paulo de Oliveira Junior</h5></center>
        </footer>
    </div>
    <script src="jQuery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/index.js"></script>
</body>
</html>