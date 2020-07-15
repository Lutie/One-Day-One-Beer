$(document).ready(function () {

    // Permet d'activer DataTable pour les tables séléctionnées
    var dataTable = $('#picture-list');
    dataTable.DataTable({
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['sorter-false']
        }, {
            'bSearchable': false,
            'aTargets': ['filter-false']
        }],
        "language": {
            "decimal": "",
            "emptyTable": "No pictures to display...",
            "info": "Display from _START_ to _END_ on _TOTAL_ results",
            "infoEmpty": "No results to display...",
            "infoFiltered": "(filter maximum of _MAX_ results)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Display _MENU_ results",
            "loadingRecords": "Loading...",
            "processing": "Searching...",
            "search": "Search :",
            "zeroRecords": "No corresponding entries",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            },
            "aria": {
                "sortAscending": ": activate for an ascending organisation of columns",
                "sortDescending": ": activate for a descending organisation of columns"
            }
        }
    });

    // Permet d'inclure une pop up de validation dans certains liens (comme ceux de suppression par exemple)
    $('.confirmation-required').click(function () {
        var text = $(this).data('text')
        return window.confirm("Are you sure you want to proceed with this action ? \n" + text)
    });

});