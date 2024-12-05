<form action="<?= isset($game) ? base_url("/admin/game/update") : base_url("/admin/game/create"); ?>"
      method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <?= isset($game) ? "Editer " . $game['name'] : "Créer une école" ?>
            </h4>
        </div>
        <div class="card-body">
            <div class="tab-content border p-3">
                <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                    <!-- Nom de l'école -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du jeux</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom de l'école"
                               value="<?= isset($game) ? $game['name'] : ""; ?>" name="name" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <?php if (isset($game)): ?>
                <input type="hidden" name="id" value="<?= $game['id']; ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">
                <?= isset($game) ? "Sauvegarder" : "Enregistrer" ?>
            </button>
        </div>
    </div>
</form>
