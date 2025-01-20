<form method="POST" action="<?= base_url('/tournament/register'); ?>">
    <label for="user_id">Utilisateur</label>
    <select name="user_id" id="user_id">
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="tournament_id">Tournoi</label>
    <select name="tournament_id" id="tournament_id">
        <?php foreach ($tournaments as $tournament): ?>
            <option value="<?= $tournament['id']; ?>"><?= $tournament['name']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Inscrire</button>
</form>
