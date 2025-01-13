<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des tournois</h4>
        <a href="<?= base_url('/admin/tournament/new'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableTournament" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <canvas id="myChart" style="display: flex; max-width: 400px; max-height: 400px;"></canvas>
</div>

<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";

        // Initialisation de la DataTable
        var dataTable = $('#tableTournament').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/tournament/SearchTournament",
                "type": "POST",
                "dataSrc": function (json) {
                    // Mettre à jour le graphique avec les données des tournois
                    updateChart(json.data);
                    return json.data;
                },
                "error": function (xhr, error, thrown) {
                    console.error("Erreur DataTables:", xhr.responseText);
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {
                    data: 'id',
                    sortable: false,
                    render: function (data) {
                        return `<a href="${baseUrl}admin/tournament/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function (data) {
                        return `<a href='${baseUrl}admin/tournament/delete/${data}'><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });

        // Configuration initiale du graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // Les noms des tournois
                datasets: [{
                    label: 'Scores des tournois',
                    data: [], // Les scores des tournois
                    backgroundColor: [], // Couleurs des barres
                    borderColor: [], // Couleurs des bordures
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Générateur de couleurs aléatoires
        function getRandomColor() {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`;
        }

        // Fonction pour mettre à jour le graphique
        function updateChart(tournamentData) {
            var names = [];
            var scores = [];
            var colors = [];
            var borderColors = [];

            // Extraire les noms, scores et générer les couleurs
            tournamentData.forEach(function (tournament) {
                names.push(tournament.name); // Nom du tournoi
                scores.push(tournament.score || 0); // Score du tournoi (0 par défaut si non défini)
                var color = getRandomColor();
                colors.push(color); // Couleur pour chaque tournoi
                borderColors.push(color.replace('0.6', '1')); // Couleur pour la bordure
            });

            // Mettre à jour les données du graphique
            myChart.data.labels = names;
            myChart.data.datasets[0].data = scores;
            myChart.data.datasets[0].backgroundColor = colors;
            myChart.data.datasets[0].borderColor = borderColors;
            myChart.update(); // Rafraîchir le graphique
        }
    });
</script>
