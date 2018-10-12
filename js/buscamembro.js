 $(document).ready(function(){

        $('#campo').keyup(function(){

            $('#frm').submit(function(){
                var dados = $(this).serialize();

                $.ajax({
                    url: 'buscamembro.php',
                    method: 'post',
                    dataType: 'html',
                    data: dados,
                    success: function(data){
                        $('#resultado').empty().html(data);
                    }
                });

                return false;
            });

            $('#frm').trigger('submit');

        });
    });
