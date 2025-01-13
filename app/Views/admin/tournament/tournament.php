<form action="<?= isset($school) ? base_url("/admin/tournament/update") : base_url("/admin/tournament/create"); ?>"
      method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <?= isset($school) ? "Editer " . $school['name'] : "Créer un tournois" ?>
            </h4>
        </div>
        <div class="card-body">
            <div class="tab-content border p-3">
                <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                    <!-- Nom de l'école -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du tournois</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom du tournois"
                               value="<?= isset($school) ? $school['name'] : ""; ?>" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Nom du jeu</label>
                        <select class="form-select" id="game" name="id_game" required>
                            <option value="" disabled <?= !isset($tournament) ? 'selected' : ''; ?>>Sélectionnez un jeu</option>
                            <?php if (isset($tournaments) && is_array($tournaments)): ?>
                                <?php foreach ($tournaments as $game): ?>
                                    <option value="<?= $game['id_game']; ?>"
                                        <?= isset($tournament) && $game['id_game'] == $tournament['id_game'] ? 'selected' : ''; ?>>
                                        <?= $game['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Aucun jeu trouvé</option>
                            <?php endif; ?>
                        </select>
                    </div>


                </div>
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
