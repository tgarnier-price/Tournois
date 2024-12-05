<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des écoles</h4>
        <a href="<?= base_url('/admin/userschool/new'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableSchool" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Slug</th>
                <th>Ville</th>
                <th>Score</th>
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
        var dataTable = $('#tableSchool').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/userschool/SearchSchool",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    console.error("Erreur DataTables:", xhr.responseText);
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},
                {"data": "city"},
                {"data": "score"},
                {"data": "actif",
                    render: function(data, type, row) {
                        var statusButton = data == 1 ?
                            `<button class="btn btn-success toggle-status" data-id="${row.id}" data-status="1">Actif</button>` :
                            `<button class="btn btn-danger toggle-status" data-id="${row.id}" data-status="0">Inactif</button>`;
                        return statusButton;
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href="${baseUrl}admin/userschool/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href='${baseUrl}admin/userschool/delete/${data}'><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });

        // Event handler to toggle status
        $('#tableSchool').on('click', '.toggle-status', function() {
            var userId = $(this).data('id');
            var newStatus = $(this).data('status');

            // Send an AJAX request to update the status
            $.ajax({
                url: baseUrl + 'admin/userschool/toggleStatus',  // Update with your correct URL
                type: 'POST',
                data: {
                    id: userId,
                    status: newStatus
                },
                success: function(response) {
                    if(response.success) {
                        // Update the button appearance after successful update
                        var button = $(this);
                        if(newStatus == 1) {
                            button.removeClass('btn-danger').addClass('btn-success').text('Actif');
                            button.data('status', 1);
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger').text('Inactif');
                            button.data('status', 0);
                        }
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
