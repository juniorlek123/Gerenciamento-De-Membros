 $(document).ready(function(){

        $('#campo').keyup(function(){

            $('#frm').submit(function(){
                var dados = $(this).serialize();

                $.ajax({
                    url: 'buscatarefa.php',
                    method: 'post',
                    dataType: 'html',
                    data: dados,
                    success: function(data){
                        $('#buscatarefa').empty().html(data);
                    }
                });

                return false;
            });

            $('#frm').trigger('submit');

        });
    });
