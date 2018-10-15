//FUNÇÃO PARA LISTAR A CONVERSSA ENQUANTO DIGITA
$('#msg').keyup(function(){
    
    ListarPosts();

    
    
});

//FUNÇÃO PARA LISTAR A CONVERSSA ENQUANTO CARREGA A PAGINA
window.onload = function(){
ListarPosts();
}

//FUNÇÃO PARA EXECUTAR COMANDOS AO CLICAR NO ENTER


var texto = document.getElementById("msg");
texto.addEventListener("focus", function() {
    texto.addEventListener('keydown', function (event) {
        if (event.keyCode == 13){
            //alert('teste');
            $('#enviar').click();
        }
    });
});

//FUNÇÃO QUE BUSCA A CONVERSSA NA BASE E LISTA
function ListarPosts()
{
 
        var listagem = "";
        var identificador = ""
        
        $.post("listagem.php", {}, function(dados){
            
            $.each(dados, function(indice, dado){

                identificador = dado.idpessoa;

                if(identificador=="1"){

                    listagem += '<div class="chat friend"><div class="user-photo"><img src="imgchat/iconechat1.png"></div><p class="chat-message">';
                    listagem += dado.msg;
                    listagem += '</p></div>'
                    listagem += "<br>";

                }

                if(identificador=="2"){

                    listagem += '<div class="chat self"><div class="user-photo"><img src="imgchat/iconeuser.png"></div><p class="chat-message">';
                    listagem += dado.msg;
                    listagem += '</p></div>'
                    listagem += "<br>";

                }
                
                
                
            });
            
            $("#chatlogs").empty();
            $("#chatlogs").append(listagem); 
            
            var objDiv = document.getElementById("chatlogs");
            objDiv.scrollTop = objDiv.scrollHeight
            
        }, "json");
    
}

//FUNÇÃO QUE LIMPA A CAIXA DA MENSAGEM DEPOIS QUE CLICA EM ENTER
function limpo() {
        if (document.getElementById('msg').value != ""){
        document.getElementById('msg').value=""; 
         
         
        }
} 

//FUNÇÃO QUE SALVA A MENSAGEM NA BASE
 $(document).ready(function(){

        $('#enviar').click(function(){

            $('#cadmsg').submit(function(){
                
                var conversssa = $(this).serialize();
                
                $.ajax({
                    url: 'msg.php',
                    method: 'post',
                    dataType: 'html',
                    data: conversssa,
                    success: function(data){
                    }
                });

                return false;
            });

            $('#cadmsg').trigger('submit');
            ListarPosts();
            limpo();
            console.log(conversssa);
            document.getElementById('msg').focus();

        });
    });