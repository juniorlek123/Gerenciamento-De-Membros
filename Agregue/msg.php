<?php

    date_default_timezone_set('America/Sao_Paulo');

    session_start();
    include('conexao.php');

    $idpessoa = "2";
    $msg=$_POST['mensagem'];
    $datahora = new datetime();
    $data = $datahora->format('y-m-d');
    $hora = $datahora->format('H:i:s');

    //NÃO PERMITE QUE SEJA ENVIADO UM VALOR ZERADO PARA A BASE DE DADOS
    if (trim($msg) == ""){     
        header("location: chat.php");   
    }
    //ENVIA A PRIMEIRA MENSAGEM DO USUÁRIO PARA A BASE CASO O VALOR DO CAMPO SEJA DIFERENTE DE NADA
    else{
        
        $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

        $stmtLogar = $con->prepare($sql);

        $stmtLogar->bindParam(1, $_SESSION['id']);
        $stmtLogar->bindParam(2, $idpessoa);
        $stmtLogar->bindParam(3, $msg);

        $stmtLogar->execute(); 
        
    // INTERAGE COM O USUÁRIO DEPENDENDO DA MENSAGEM INICIAL DELE
    if ((trim($msg) == "oi" && $_SESSION['primeira']=="")||(trim($msg) == "OI" && $_SESSION['primeira']=="")||(trim($msg) == "Oi" && $_SESSION['primeira']=="")||(trim($msg) == "Olá" && $_SESSION['primeira']=="")||(trim($msg) == "Ola" && $_SESSION['primeira']=="")||(trim($msg) == "OLA" && $_SESSION['primeira']=="")){

        $idpessoa = "1";
        $msg = 'Vamos lá, digite: <br><br> 1 - Para Efetuar um Agendamento <br> 2 - Para Cancelar um Agendamento';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();

            $_SESSION['primeira'] = "oi";
        
            header("location: chat.php");

    }
    // CASO O USUÁRIO ESCOLHA A OPÇÃO 1  
    else if(trim($msg) == "1" && $_SESSION['primeira'] == "oi") {

        $idpessoa = "1";
        $msg = 'Os Horários Disponiveis estão listados proximos a este chat, fique a vontade para escolher o melhor horário de acordo com a numeração da lista, então digite aqui o numero correspondente ao horário escolhido';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();

            $_SESSION['primeira'] = "agendamento";
        
            header("location: chat.php");

    }
    // SALVA O HORARIO ESCOLHIDO PELO USUÁRIO
    else if((trim($msg) == "1" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "2" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "3" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "4" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "5" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "6" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "7" && $_SESSION['primeira'] == "agendamento")||(trim($msg) == "8" && $_SESSION['primeira'] == "agendamento")) {

        $idpessoa = "1";
        $hora = "";
        $disponivel = "S";

            $sql = "SELECT * FROM horarios WHERE ordem = ? and disp = ? ";

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $msg);
            $stmtLogar->bindParam(2, $disponivel);

            $stmtLogar->execute();

            $id = $stmtLogar->fetch(PDO::FETCH_ASSOC);

            $hora = ($id['horario']);
            $_SESSION['horario'] = $hora;
        
            if ($hora > ""){
        
                // ENVIA MENSAGEM DIZENDO QUAL FOI O HORARIO ESCOLHIDO PELO USUÁRIO
                $msg = 'O Horário escolhido foi '.$hora.' Confirma o agendamento ? S ou N'     ;

                $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

                $stmtLogar = $con->prepare($sql);

                $stmtLogar->bindParam(1, $_SESSION['id']);
                $stmtLogar->bindParam(2, $idpessoa);
                $stmtLogar->bindParam(3, $msg);

                $stmtLogar->execute();

                $_SESSION['primeira'] = "escolhido";

                header("location: chat.php");
            }
            
                else {
                    
                // ENVIA MENSAGEM DIZENDO CASO O HORÁRIO NÃO ESTEJA DISPONÍVEL
                $idpessoa = "1";
                $msg = 'Desculpe, o horario que você escolheu não existe ou não está disponível, tente digitar o numero correspondente ao horario novamente';

                $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

                $stmtLogar = $con->prepare($sql);

                $stmtLogar->bindParam(1, $_SESSION['id']);
                $stmtLogar->bindParam(2, $idpessoa);
                $stmtLogar->bindParam(3, $msg);

                $stmtLogar->execute();

                header("location: chat.php");
                }

    }
        
    else if((trim($msg) == "s" && $_SESSION['primeira'] == "escolhido")||(trim($msg) == "S" && $_SESSION['primeira'] == "escolhido")){
        
        $idpessoa = "1";
        $msg = 'Tudo certo seu horário foi agendado com sucesso para as ' .$_SESSION['horario']. ' horas' ;

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
        
            $sit = "AGENDADO";
        
            $sql = 'INSERT INTO agendamentos (data, hora, email, nome, telefone, idchat, situaçao) VALUES(?, ?, ?, ?, ?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $data);
            $stmtLogar->bindParam(2, $_SESSION['horario']);
            $stmtLogar->bindParam(3, $_SESSION['email']);
            $stmtLogar->bindParam(4, $_SESSION['nome']);
            $stmtLogar->bindParam(5, $_SESSION['tel']);
            $stmtLogar->bindParam(6, $_SESSION['id']);
            $stmtLogar->bindParam(7, $sit);

            $stmtLogar->execute();
        
        $sql = "SELECT * FROM agendamentos WHERE idchat = ? ";

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);

            $stmtLogar->execute();

            $id = $stmtLogar->fetch(PDO::FETCH_ASSOC);
        
        $idpessoa = "1";
        $natendimento = ($id['id']);
        $msg = 'O Número do seu agendamentos é ' .$natendimento. ' utilize o mesmo para cancelamento caso seja necessário' ;

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
        
            $ocupa = "N";
        
            $sql = ("UPDATE horarios SET disp= ? WHERE horario= ?");

            $stmtCad = $con->prepare($sql);
            $stmtCad->bindParam(1, $ocupa);
            $stmtCad->bindParam(2, $_SESSION['horario']);

            $stmtCad->execute();
        
        $idpessoa = "1";
        $msg = 'Aguardamos você ansiosamente para poder atende-lo, lembrando que se por algum motivo você não puder vir no horario agendado peço que previamente entre em contato comigo para podermos cancelar o agendamento, Por favor digite F - para finalizar o atendimento <br><br> Atencisamente <br> ChatBô - Volte Sempre !!!';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
        
        $_SESSION['primeira'] = "agendado";
        
        header("location: chat.php");
        
    }
        
    else if((trim($msg) == "n" && $_SESSION['primeira'] == "escolhido")||(trim($msg) == "N" && $_SESSION['primeira'] == "escolhido")){
        
        $idpessoa = "1";
        $msg = 'Tudo bem, os horários disponiveis estão listados proximos a este chat, fique a vontade para escolher o melhor horário de acordo com a numeração da lista, então digite aqui o numero correspondente ao horário escolhido';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();

            $_SESSION['primeira'] = "agendamento";
        
            header("location: chat.php");

    }
        
    //REDIRECIONAMENTO PARA A TELA DE AVALIAÇÃO DO ATENDIMENTO
    else if((trim($msg) == "F" && $_SESSION['primeira']=="agendado")||(trim($msg) == "f" && $_SESSION['primeira']=="agendado")){
        
        header("location: logout.php");
        
    }
        
        
    // CASO O USUÁRIO ESCOLHA A OPÇÃO 2
    else if(trim($msg) == "2" && $_SESSION['primeira'] == "oi") {

        $idpessoa = "1";
        $msg = 'Para cancelar, por favor, digite o numero do seu agendamento:';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();

            $_SESSION['primeira'] = "cancelamento";
        
            header("location: chat.php");
    
    }
    
    //VERIFICA SE O Nº DO HORÁRIO ESTÁ DEVIDAMENTE REGISTRADO E PEDE MAIS UM DADO PARA CANCELAMENTO
    else if ((is_numeric(trim($msg))) && (trim($msg) > '0') && ($_SESSION['primeira'] == "cancelamento")){
        
        $sql = "SELECT * FROM agendamentos WHERE id = ? ";

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $msg);

            $stmtLogar->execute();

            $id = $stmtLogar->fetch(PDO::FETCH_ASSOC);

            $_SESSION['idagen'] = ($id['id']);
            $_SESSION['horario'] = ($id['hora']);
        
                if ($_SESSION['idagen']==""){

                $idpessoa = "1";
                $msg = 'Desculpe, não consegui encontrar seu agendamento, poderia por favor digitar novamente seu numero de agendamento';

                $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

                $stmtLogar = $con->prepare($sql);

                $stmtLogar->bindParam(1, $_SESSION['id']);
                $stmtLogar->bindParam(2, $idpessoa);
                $stmtLogar->bindParam(3, $msg);

                $stmtLogar->execute();

                $_SESSION['primeira'] = "cancelamento";

                }
                else{
                    
                $sql = "SELECT * FROM agendamentos WHERE id = ? ";

                $stmtLogar = $con->prepare($sql);

                $stmtLogar->bindParam(1, $_SESSION['idagen']);

                $stmtLogar->execute();

                $id = $stmtLogar->fetch(PDO::FETCH_ASSOC);
                    
                $_SESSION['email'] = ($id['email']);
        
                $idpessoa = "1";
                $natendimento = ($id['id']);
                
                $idpessoa = "1";
                $msg = 'Para confirmar o cancelamento, preciso que você digite o email que foi utilizado no horário do agendamento:';

                $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

                $stmtLogar = $con->prepare($sql);

                $stmtLogar->bindParam(1, $_SESSION['id']);
                $stmtLogar->bindParam(2, $idpessoa);
                $stmtLogar->bindParam(3, $msg);

                $stmtLogar->execute();

                $_SESSION['primeira'] = "cancelamento-email";
                    
                }
        
            header("location: chat.php");
    }
      
    // COMANDO CASO O USUÁRIO DIGITE O EMAIL CORRETO DE ACORDO COM O CADASTRO
    else if ((trim($msg)) == ($_SESSION['email']) && ($_SESSION['primeira'] = "cancelamento-email")){
        
        //UPDATE NO HORARIO CANCELADO
        
        $ocupa = "S";
        
        $sql = ("UPDATE horarios SET disp= ? WHERE horario = ?");

            $stmtCad = $con->prepare($sql);
            $stmtCad->bindParam(1, $ocupa);
            $stmtCad->bindParam(2, $_SESSION['horario']);

            $stmtCad->execute();
        
        //UPDATE NO AGENDAMENTO EM SI
        
        $sit = "CANCELADO";
        
        $sql = ("UPDATE agendamentos SET situaçao= ? WHERE id = ?");

            $stmtCad = $con->prepare($sql);
            $stmtCad->bindParam(1, $sit);
            $stmtCad->bindParam(2, $_SESSION['idagen']);

            $stmtCad->execute();
        
            //header("location: chat.php");
        
        $idpessoa = "1";
        $msg = 'Cancelamento efetuado com sucesso, Obrigado por levar em consideração a necessidade de outras pessoas, Por favor digite F - para finalizar o atendimento <br><br> Atencisamente <br> ChatBô - Volte Sempre !!!';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
        
        $_SESSION['primeira'] = "cancelado";
        
        header("location: chat.php");
        
    }
        
        //REDIRECIONAMENTO PARA A TELA DE AVALIAÇÃO DO ATENDIMENTO
        else if((trim($msg) == "F" && $_SESSION['primeira']=="cancelado")||($msg == "f" && $_SESSION['primeira']=="cancelado")){
        
        header("location: logout.php");
        
    }
        
    //COMANDO PARA ENCERRAR IMEDIATAMENTE O CHAT
        
    else if((trim($msg) == "Sair")||(trim($msg) == "sair")||(trim($msg) == "SAIR")){
         
        $idpessoa = "1";
        $msg = 'Vi que você optou por ecerrarmos por aqui, tudo bem, estarei encerrando seu atendimento, então até mais... <br><br> Atenciosamente <br> ChatBô';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
        
        $_SESSION['sair'] = 'sim';
         
        header("location: chat.php");    
     }   
    
    //COMANDO PARA REINICIAR O CHAT
        
    else if((trim($msg) == "Inicio")||(trim($msg) == "inicio")||(trim($msg) == "INICIO")){
         
        $idpessoa = "1";
        $msg = 'Tudo bem, vamos começar do início, Vamos lá, digite: <br><br> 1 - Para Efetuar um Agendamento <br> 2 - Para Cancelar um Agendamento ';

        $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

        $stmtLogar = $con->prepare($sql);

        $stmtLogar->bindParam(1, $_SESSION['id']);
        $stmtLogar->bindParam(2, $idpessoa);
        $stmtLogar->bindParam(3, $msg);

        $stmtLogar->execute();
        
        $_SESSION['horario']= '';
        $_SESSION['primeira']= 'oi';
        $_SESSION['idagen']= '';
        $_SESSION['sair'] = '';
         
        header("location: chat.php");    
     }   
        
    //MENSAGEM CASO O USUÁRIO DIGITE O EMAIL ERRADO
    else if ((trim($msg)) != ($_SESSION['email']) && ($_SESSION['primeira'] == "cancelamento-email")){
        
        $idpessoa = "1";
        $msg = 'Desculpe, o endereço de email digitado não corresponde ao utilizado no momento do agendamento, por favor tente novamente';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
         
            header("location: chat.php");
        
    }  
        
    //MENSAGEM CASO O USUÁRIO ESCOLHA UM HORÁRIO QUE NÃO ESTEJA DISPONÍVEL
     else if((trim($msg) == "0" && $_SESSION['primeira'] == "agendamento")||(trim($msg) > "8" && $_SESSION['primeira'] == "agendamentos")){
         
        $idpessoa = "1";
        $msg = 'Desculpe, o horario que você escolheu não existe ou não está disponível, tente digitar o numero correspondente ao horario novamente';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
         
            header("location: chat.php");
     }   
        
    // MENSAGEM EXIBIDA CASO O O ROBO NÃO ENTENDO O QUE O USUARIO DISSE 
     else{

        $idpessoa = "1";
        $msg = 'Desculpe, sou um robô novo e ainda estou aprendendo, por isso não entendi o que quis dizer, por favor tente novamente';

            $sql = 'INSERT INTO converssa (idacesso, idpessoa, msg ) VALUES(?, ?, ?)';

            $stmtLogar = $con->prepare($sql);

            $stmtLogar->bindParam(1, $_SESSION['id']);
            $stmtLogar->bindParam(2, $idpessoa);
            $stmtLogar->bindParam(3, $msg);

            $stmtLogar->execute();
         
            header("location: chat.php");

    }
          
        //header("location: chat.php");
        
    }

?>