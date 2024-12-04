<form action="<?= isset($school) ? base_url("/admin/userschool/update") : base_url("/admin/userschool/create"); ?>"
      method="POST">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <?= isset($school) ? "Editer " . $school['name'] : "Créer une école" ?>
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nom de l'ecole'</label>
                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($school) ? $school['name'] : ""; ?>" name="name">
            </div>
        </div>
        <div class="card-footer text-end">
            <?php if (isset($school)): ?>
                <input type="hidden" name="id" value="<?= $school['id']; ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">
                <?= isset($school) ? "Sauvegarder" : "Enregistrer" ?>
            </button>
        </div>
    </div>
</form>
