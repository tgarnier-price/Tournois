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
                        return `<a href="${baseUrl}admin/userschool/${data}"><i class="fa-solid
                        fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href='${baseUrl}admin/userschool/delete/${data}'><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
    });

</script>