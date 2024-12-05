<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des categories</h4>
        <a href="<?= base_url('/admin/categoryschool/new'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableCategorySchool" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
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
        var dataTable = $('#tableCategorySchool').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/categoryschool/SearchCategorySchool",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/categoryschool/${data}"><i class="fa-solid
                        fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href='${baseUrl}admin/categoryschool/delete/${data}'><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
    });

</script>
