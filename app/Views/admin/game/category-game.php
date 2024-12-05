<form action="<?= isset($categorygame) ? base_url("/admin/categorygame/update") : base_url("/admin/categorygame/create"); ?>"
      method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <?= isset($categorygame) ? "Editer " . $categorygame['name'] : "Créer une categorie" ?>
            </h4>
        </div>
        <div class="card-body">
            <div class="tab-content border p-3">
                <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de la categorie</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom de la categorie"
                               value="<?= isset($categorygame) ? $categorygame['name'] : ""; ?>" name="name" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <?php if (isset($categorygame)): ?>
                <input type="hidden" name="id" value="<?= $categorygame['id']; ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">
                <?= isset($categorygame) ? "Sauvegarder" : "Enregistrer" ?>
            </button>
        </div>
    </div>
</form>
