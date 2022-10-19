$(document).ready(function(){

    const DT_PT = {
        "sEmptyTable":   "Não foi encontrado nenhum registo",
        "sLoadingRecords": "A carregar...",
        "sProcessing":   "A processar...",
        "sLengthMenu":   "Mostrar _MENU_ registos",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
        "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Procurar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        },
        "oAria": {
            "sSortAscending":  ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    }


    $('.dataTable').DataTable({
        'oLanguage': DT_PT,

        responsive: true, 
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]

    }); 


    $('.produtos').DataTable({

        'oLanguage': DATATABLE_PTBR,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-download"></i>',
                title: 'Lista de produtos cadastrados',
                filename: 'Produtos cadastrados',
                titleAttr: 'Exportar para PDF',
                className: 'btn btn-primary btn-sm',
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['no-sort']
            }],
    });

}); 

