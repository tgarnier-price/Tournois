<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tournament extends BaseController
{
    protected $require_auth = true;
    protected $requiredRoles = ['administrateur'];

    public function getindex($id = null) {
        $g = model("TournamentModel");

        if ($id == null) {
            return $this->view('/admin/tournament/index-tournament', [], true);
        } else {
            if ($id == "new") {
                // Récupérer tous les tournois avec les noms des jeux
                $tournaments = $g->getAllTournamentsWithGames();
                return $this->view('/admin/tournament/tournament', ["tournaments" => $tournaments], true);
            }
            // Si l'ID est un tournoi existant, récupérez ses informations
            $tournament = $g->getTournamentById($id);
            return $this->view('/admin/game/index-tournament', ["tournament" => $tournament], true);
        }
    }


    public function postUpdate() {
        $data = $this->request->getPost();

        if (!isset($data['id']) || !is_numeric($data['id'])) {
            $this->error("ID du tournoi manquant ou invalide");
            return $this->redirect('/admin/tournament');
        }

        $t = model('TournamentModel');

        if ($t->updateTournament((int)$data['id'], $data)) {
            $this->success("Le tournoi a bien été modifié");
        } else {
            $this->error("Une erreur est survenue lors de la mise à jour");
        }

        return $this->redirect('/admin/tournament');
    }


    public function postCreate() {
        $data = $this->request->getPost();
        $t = model('TournamentModel');

        if ($t->createTournament($data)) {
            $this->success("Le tournoi a bien été ajouté.");
        } else {
            $errors = $t->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
            return $this->redirect('/admin/tournament/new');
        }

        return $this->redirect('/admin/tournament');
    }

    public function getDelete($id) {
        $t = model('TournamentModel');

        if ($t->deleteTournament($id)) {
            $this->success("Tournoi supprimé");
        } else {
            $this->error("Une erreur est survenue lors de la suppression du tournoi");
        }

        return $this->redirect('/admin/tournament');
    }

    public function postSearchTournament() {
        $TournamentModel = model('TournamentModel');

        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        $orderColumnIndex = $this->request->getPost('order')[0]['column'];
        $orderDirection   = $this->request->getPost('order')[0]['dir'];
        $orderColumnName  = $this->request->getPost('columns')[$orderColumnIndex]['data'];

        $data = $TournamentModel->getPaginatedTournament($start, $length, $searchValue, $orderColumnName, $orderDirection);

        $totalRecords    = $TournamentModel->getTotalTournament();
        $filteredRecords = $TournamentModel->getFilteredTournament($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];

        return $this->response->setJSON($result);
    }

    public function getDeactivate($id) {
        $t = model('TournamentModel');

        if ($t->deactivateTournament($id)) {
            $this->success("Tournoi désactivé");
        } else {
            $this->error("Une erreur est survenue lors de la désactivation du tournoi");
        }

        return $this->redirect('/admin/tournament');
    }

    public function getActivate($id) {
        $t = model('TournamentModel');

        if ($t->activateTournament($id)) {
            $this->success("Tournoi activé");
        } else {
            $this->error("Une erreur est survenue lors de l'activation du tournoi");
        }

        return $this->redirect('/admin/tournament');
    }
}