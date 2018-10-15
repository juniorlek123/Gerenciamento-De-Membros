<html>
<head>
    <?php
    session_start();
    
    if (isSet($_SESSION['iniciado'])){
            
            if($_SESSION['iniciado'] == 'fora')
            {
                header("refresh: 10;index.php");
            }
            else{
                header("location: index.php");
            }
    } 
    ?>
    <title>ChatBô</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/iconePagina.png" type="image/x-png">
    <meta charset="utf-8">
</head>
<body>
    <div class="container-fluid">
        <centeR>
            <h1 class="loginTitulo">Fora do Horário de Atendimento</h1>
        </centeR>
        <hr>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form class="Logar" name="singnup" method="post" action="logar.php">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      Muito Obrigado pela preferência, porém não consigo realizar seu atendimento agora, por favor tente novamente no horário entre as 4:00 e 17:00 horas.
                    </div>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
         <footer class="rodape">
            <center><h5>© 2018 - Desenvolvido por José Paulo de Oliveira Junior</h5></center>
        </footer>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
