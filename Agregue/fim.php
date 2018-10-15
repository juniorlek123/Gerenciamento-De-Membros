<html>
<head>
    <?php
    session_start();
    
    if (isSet($_SESSION['iniciado'])){
            
            if($_SESSION['iniciado'] == 'encerrado')
            {
                header("refresh: 10;index.html");
            }
            else{
                
                header("location: index.html");
            }
    }
    
    ?>
    <title>ChatBô</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="estilo/chat.css">
    <link rel="shortcut icon" href="imgchat/iconePagina.png" type="image/x-png">
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid">
        <centeR>
            <h1 class="loginTitulo">Atendimento Finalizado</h1>
        </centeR>
        <hr>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form class="Logar" name="singnup" method="post" action="logar.php">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      Muito Obrigado pela preferência, esperamos que possa sempre contar conosco, em instantes você será redirecionado para a nossa página Principal.
                    </div>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
         <footer class="rodape">
            <center><h5 class="loginTitulo">© 2018 - Desenvolvido por José Paulo de Oliveira Junior</h5></center>
        </footer>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
