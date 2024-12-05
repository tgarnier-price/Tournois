<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class CategoryGame extends BaseController
{
    protected $require_auth = true;
    protected $requiredCategoryGames = ['administrateur'];
    public function getindex($id = null) {
        if ($id == null) {
            return $this->view('/admin/game/index-category-game', [], true);
        } else {
            $cg = Model("CategoryGameModel");
            if ($id == "new") {
                return $this->view('/admin/game/category-game', [], true);
            }
            $categorygame = $cg->getCategoryGameById($id);
            return $this->view('/admin/game/category-game', ["categorygame" => $categorygame], true);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $cg = Model("/CategoryGameModel");
        if ($cg->updateCategoryGame($data['id'], $data)) {
            $this->success("Categorie Jeux à bien été modifié");
        } else {
            $this->error("Une erreur est survenue");
        }
        $this->redirect("/admin/game");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $cg = Model("CategoryGameModel");
        if ($cg->createCategoryGame($data)) {
            $this->success("Le jeux à bien été ajouté.");
            $this->redirect("/admin/game");
        } else {
            $errors = $cg->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
            $this->redirect("/admin/game/new");
        }
    }

    public function getdelete($id){
        $g = Model('CategoryGameModel');
        if ($g->deleteCategoryGame($id)) {
            $this->success("jeux supprimé");
        } else {
            $this->error("jeux non supprimé");
        }
        $this->redirect('/admin/game');
    }

    public function postSearchCategoryGame()
    {
        $CategoryGameModel = model('CategoryGameModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'];
        $orderDirection = $this->request->getPost('order')[0]['dir'];
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'];

        // Obtenez les données triées et filtrées
        $data = $CategoryGameModel->getPaginatedCategoryGame($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CategoryGameModel->getTotalCategoryGame();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CategoryGameModel->getFilteredCategoryGame($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function getdeactivate($id){
        $g = Model('CategoryGameModel');
        if ($g->deactivateCategoryGame($id)) {
            $this->success("Jeux désactivée");
        } else {
            $this->error("Jeux non désactivée");
        }
        $this->redirect('/admin/game');
    }

    public function getactivate($id){
        $g = Model('CategoryGameModel');
        if ($g->activateCategoryGame($id)) {
            $this->success("Jeux activée");
        } else {
            $this->error("Jeux non activée");
        }
        $this->redirect('/admin/game');
    }
}