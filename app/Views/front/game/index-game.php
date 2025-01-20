<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des jeux</h4>
    </div>
    <div class="card-body">
        <table id="tableGame" class="table table-hover">
            <thead>
            <tr>
                <th>Nom</th>
                <th>ID Categorie</th>
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
                {"data": "name"},
                {"data": "id_category"},
            ]
        });
    });
</script>

