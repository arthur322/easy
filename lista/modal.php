<div id="delete-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Excluir produto</h4>
            </div>
            <div class="modal-body">
                <p class="modal-text"></p>
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-danger" href="#">Excluir</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#delete-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('codigo');
        var nome = button.data('nome');
        var modal = $(this);
        modal.find('.modal-title').text('Excluir produto #' + id);
        modal.find('.modal-text').text('Deseja realmente excluir o produto [' + nome + "] ?");
        modal.find('#confirm').attr('href', 'delete.php?id=' + id);
    })
</script>