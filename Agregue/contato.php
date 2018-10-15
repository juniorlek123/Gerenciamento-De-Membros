<?php

    date_default_timezone_set('America/Sao_Paulo');
    header("Content-type: text/html; charset=utf-8");

    session_start();
    include('conexao.php');

    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $telefone=$_POST['tel'];
    $msg=$_POST['msg'];;
    $datahora = new datetime();
    $data = $datahora->format('y-m-d');
    $hora = $datahora->format('H:i:s');
    $lida = "Não";

    $emailauto = "contato@wedeskapp.com.br";

    $sql = 'INSERT INTO tbcontato (nome, email, telefone, msg, data, hora, lida ) VALUES(?, ?, ?, ?, ?, ?, ?)';

        $stmtLogar = $con->prepare($sql);

        $stmtLogar->bindParam(1, $nome);
        $stmtLogar->bindParam(2, $email);
        $stmtLogar->bindParam(3, $telefone);
        $stmtLogar->bindParam(4, $msg);
        $stmtLogar->bindParam(5, $data);
        $stmtLogar->bindParam(6, $hora);
        $stmtLogar->bindParam(7, $lida);

        $stmtLogar->execute(); 

        //Mensagem para a pessoa que enviou o contato
        $para = $email;
        $assunto = 'Contato pelo site';
        $nome1 = $nome;
        $fone = $telefone;
        $email1 = $emailauto;
        $msg1 = $msg;

            $corpo = "<strong>Mensagem de Contato</strong><br><br>";

            $header="Content-Type: text/html; charset= utf-8\n";
            $header .="From: $email Reply-to: $email\n";
        
        mail($para, $assunto, $corpo, $header);
        
        echo "<script>alert('Email enviado com sucesso !!!');location.href=\"index.html\";</script>";
    

?>