<?php
namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model {

    protected $table = 'participant';
    protected $allowedFields = ['id_user', 'id_tournament'];

    public function registerUserToTournament($id_user, $id_tournament) {
        return $this->insert([
            'id_user' => $id_user,
            'id_tournament' => $id_tournament
        ]);
    }
}