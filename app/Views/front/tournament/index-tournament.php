<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des tournois</h4>
        <a href="<?= base_url('/participant'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableTournament" class="table table-hover">
            <thead>
            <tr>
                <th>Nom</th>
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

        // Initialisation de la DataTable
        var dataTable = $('#tableTournament').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            language: {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            ajax: {
                url: baseUrl + "admin/tournament/SearchTournament",
                type: "POST",
                dataSrc: function (json) {
                    return json.data;
                },
                error: function (xhr, error, thrown) {
                    alert("Une erreur est survenue lors du chargement des données.");
                    console.error("Erreur DataTables:", xhr.responseText);
                }
            },
            columns: [
                { data: "name" },
            ]
        });
    });

</script>
