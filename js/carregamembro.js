//PROCEDIMENTO PARA PREENCHER OS DADOS DO MEMBRO PARA PODER EDITAR
$('#editmembro').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) // Button that triggered the modal
var id = button.data('id') // Extract info from data-* attributes
var nome = button.data('nome')
var email = button.data('email')
var telefone = button.data('telefone')
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
var modal = $(this)
modal.find('#id').val(id)
modal.find('#txtNome').val(nome)
modal.find('#txtEmail').val(email)
modal.find('#txtTel').val(telefone)
})
//PROCEDIMENTO PARA PEGAR O ID DO MEMBRO QUE DESEJA EXCLUIR
$('#confexcmembro').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) // Button that triggered the modal
var id = button.data('id') // Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
var modal = $(this)
modal.find('#id').val(id)
})
