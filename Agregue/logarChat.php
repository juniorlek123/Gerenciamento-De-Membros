<?php

    date_default_timezone_set('America/Sao_Paulo');

    session_start();
    include('conexao.php');

    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $datahora = new datetime();
    $data = $datahora->format('y-m-d');
    $hora = $datahora->format('H:i:s');

    //INSERE OS DADOS DO ACESSO DO USUÁRIO NA BASE

    $sql = 'INSERT INTO tbacessos (nome,  email, telefone, data, hora ) VALUES(?, ?, ?, ?, ?)';

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $nome);
    $stmtLogar->bindParam(2, $email);
    $stmtLogar->bindParam(3, $tel);
    $stmtLogar->bindParam(4, $data);
    $stmtLogar->bindParam(5, $hora);

    $stmtLogar->execute(); 

    $_SESSION['nome']= $nome;
    $_SESSION['email']= $email;
    $_SESSION['tel']= $tel;
    $_SESSION['sair'] = "";

    //PEGA A VARIÁVEL DE SESSÃO ID DO USUÁRIO

    $sql = "SELECT * FROM tbacessos WHERE nome = ? and data = ? and hora = ? and email = ? and telefone = ?";

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $nome);
    $stmtLogar->bindParam(2, $data);
    $stmtLogar->bindParam(3, $hora);
    $stmtLogar->bindParam(4, $email);
    $stmtLogar->bindParam(5, $tel);

    $stmtLogar->execute(); 

    $id = $stmtLogar->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id']= ($id['id']);

    //SALVA NA TABELA DE CONVERSSAS A PRIMEIRA MENSAGEM ENVIADA PELO ROBO

    $idrobo = "1";
    $msg = "Olá, Seja bem vindo ao nosso chat";

    $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

    $stmtLogar = $con->prepare($sql);

    $stmtLogar->bindParam(1, $_SESSION['id']);
    $stmtLogar->bindParam(2, $idrobo);
    $stmtLogar->bindParam(3, $msg);

    $stmtLogar->execute(); 
    
    if($hora < "24:00:00"){
        
        $_SESSION['iniciado']= "iniciado";
        header("location: chat.php");
        
    }
    else{
        
        $_SESSION['iniciado']= "fora";
        header("location: ForaDoHorario.php");
        
    }

    
    
?>