<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des jeux</h4>
        <a href="<?= base_url('/admin/game/new'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableGame" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>ID Categorie</th>
                <th>Actif</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableGame').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/game/SearchGame",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    console.error("Erreur DataTables:", xhr.responseText);
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "id_category"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver le jeux" href="${baseUrl}admin/game/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-success"></i></a>`: `<a title="Activer le jeux"href="${baseUrl}admin/game/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href="${baseUrl}admin/game/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href='${baseUrl}admin/game/delete/${data}'><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });

        // Event handler to toggle status
        $('#tableGame').on('click', '.toggle-status', function() {
            var userId = $(this).data('id');
            var newStatus = $(this).data('status');

            // Send an AJAX request to update the status
            $.ajax({
                url: baseUrl + 'admin/game/toggleStatus',  // Update with your correct URL
                type: 'POST',
                data: {
                    id: userId,
                    status: newStatus
                },
                success: function(response) {
                    if(response.success) {
                        // Update the icon after successful update
                        var button = $(this);
                        if(newStatus == 1) {
                            button.find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                        } else {
                            button.find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                        }
                        // Update the status in the table
                        button.data('status', newStatus);
                    } else {
                        alert('Erreur lors de la mise à jour du statut.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', xhr.responseText);
                }
            });
        });
    });
</script>

