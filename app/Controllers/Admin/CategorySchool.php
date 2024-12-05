<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class CategorySchool extends BaseController
{
    protected $require_auth = true;
    protected $requiredCategorySchool = ['administrateur'];
    public function getindex($id = null) {
        if ($id == null) {
            return $this->view('/admin/user/index-category-school', [], true);
        } else {
            $cs = Model("CategorySchoolModel");
            if ($id == "new") {
                return $this->view('/admin/user/category-school', [], true);
            }
            $categoryschool = $cs->getCategorySchoolById($id);
            return $this->view('/admin/user/category-school', ["categoryschool" => $categoryschool], true);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $cs = Model("/CategorySchoolModel");
        if ($cs->updateCategorySchool($data['id'], $data)) {
            $this->success("Categorie Jeux à bien été modifié");
        } else {
            $this->error("Une erreur est survenue");
        }
        $this->redirect("/admin/school");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $cs = Model("CategorySchoolModel");
        if ($cs->createCategorySchool($data)) {
            $this->success("Le jeux à bien été ajouté.");
            $this->redirect("/admin/school");
        } else {
            $errors = $cs->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
            $this->redirect("/admin/school/new");
        }
    }

    public function getdelete($id){
        $g = Model('CategorySchoolModel');
        if ($g->deleteCategorySchool($id)) {
            $this->success("jeux supprimé");
        } else {
            $this->error("jeux non supprimé");
        }
        $this->redirect('/admin/school');
    }

    public function postSearchCategorySchool()
    {
        $CategorySchoolModel = model('CategorySchoolModel');

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
        $data = $CategorySchoolModel->getPaginatedCategorySchool($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CategorySchoolModel->getTotalCategorySchool();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CategorySchoolModel->getFilteredCategorySchool($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function getdeactivate($id){
        $g = Model('CategorySchoolModel');
        if ($g->deactivateCategorySchool($id)) {
            $this->success("Jeux désactivée");
        } else {
            $this->error("Jeux non désactivée");
        }
        $this->redirect('/admin/school');
    }

    public function getactivate($id){
        $g = Model('CategorySchoolModel');
        if ($g->activateCategorySchool($id)) {
            $this->success("Jeux activée");
        } else {
            $this->error("Jeux non activée");
        }
        $this->redirect('/admin/school');
    }
}