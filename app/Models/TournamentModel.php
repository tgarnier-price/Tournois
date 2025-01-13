<?php

namespace App\Models;

use CodeIgniter\Model;

class TournamentModel extends Model
{
    protected $table = 'tournament';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_game', 'name'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Le nom du tournoi est requis.',
            'min_length' => 'Le nom du tournoi doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom du tournoi ne doit pas dépasser 100 caractères.',
        ],
    ];

    public function createTournament($data) {
        return $this->insert($data);
    }

    public function updateTournament($id, $data) {
        return $this->update($id, $data);
    }

    public function getTournamentById($id) {
        return $this->find($id);
    }

    public function getAllTournament() {
        return $this->findAll();
    }

    public function deleteTournament($id) {
        return $this->delete($id);
    }

    public function deactivateTournament($id) {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function activateTournament($id) {
        return $this->update($id, ['deleted_at' => null]);
    }

    public function getPaginatedTournament($start, $length, $searchValue, $orderColumnName, $orderDirection) {
        $builder = $this->builder();

        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        if (!empty($orderColumnName) && !empty($orderDirection)) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalTournament() {
        return $this->countAll();
    }

    public function getAllTournamentsWithGames() {
        return $this->select('tournament.id_game, game.name')
            ->join('game', 'game.id = tournament.id_game')
            ->findAll();
    }


    public function getFilteredTournament($searchValue) {
        $builder = $this->builder();

        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
