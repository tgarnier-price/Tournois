<form action="<?= isset($school) ? base_url("/admin/userschool/update") : base_url("/admin/userschool/create"); ?>"
      method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <?= isset($school) ? "Editer " . $school['name'] : "Créer une école" ?>
            </h4>
        </div>
        <div class="card-body">
            <div class="tab-content border p-3">
                <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                    <!-- Nom de l'école -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'école</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom de l'école"
                               value="<?= isset($school) ? $school['name'] : ""; ?>" name="name" required>
                    </div>

                    <!-- Ville -->
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" placeholder="Ville"
                               value="<?= isset($school) ? $school['city'] : ""; ?>" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie du jeu</label>
                        <select class="form-select" id="category" name="id_category" required>
                            <option value="" disabled <?= !isset($categoryschool) ? 'selected' : ''; ?>>Sélectionnez une catégorie</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"
                                    <?= isset($categoryschool) && $categoryschool['id'] == $category['id'] ? 'selected' : ''; ?>>
                                    <?= $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Score -->
                    <div class="mb-3">
                        <label for="score" class="form-label">Score</label>
                        <input type="number" class="form-control" id="score" placeholder="Score" step="0.1"
                               value="<?= isset($school) ? $school['score'] : ""; ?>" name="score" required>
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
