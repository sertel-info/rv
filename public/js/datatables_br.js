$.extend( true, $.fn.dataTable.defaults, {
    "processing": true,
    "serverSide": false,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    "pageLength": 10,
    "language": {
        "loadingRecords": "Carregando...",
        "emptyTable": "Nenhum registro encontrado.",
        "processing": "Processando...",
        "search": "Pesquisar",
        "lengthMenu": "Mostrar _MENU_ registro por página.",
        "zeroRecords": "Nenhum registro encontrado.",
        "info": "Mostrando página _PAGE_ de um total de  _PAGES_",
        "infoEmpty": "Sem registros para exibir.",
        "infoFiltered": "(filtrado do total _MAX_ registros)",
        "paginate": {
            "previous": "Anterior",
            "next": "Próxima"
        }
    }
});
