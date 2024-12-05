<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Userschool extends BaseController
{
    protected $require_auth = true;
    protected $requiredSchools = ['administrateur'];
    public function getindex($id = null) {
        if ($id == null) {
            return $this->view('/admin/user/index-school', [], true);
        } else {
            $us = Model("UserSchoolModel");
            if ($id == "new") {
                return $this->view('/admin/user/user-school', [], true);
            }
            $school = $us->getUserSchoolById($id);
            return $this->view('/admin/user/user-school', ["school" => $school], true);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $us = Model("/UserSchoolModel");
        if ($us->updateSchool($data['id'], $data)) {
            $this->success("Ecole à bien été modifié");
        } else {
            $this->error("Une erreur est survenue");
        }
        $this->redirect("/admin/userschool");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $us = Model("UserSchoolModel");
        if ($us->createSchool($data)) {
            $this->success("Le rôle à bien été ajouté.");
            $this->redirect("/admin/userschool");
        } else {
            $errors = $us->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
            $this->redirect("/admin/userschool/new");
        }
    }

    public function getdelete($id){
        $us = Model('UserSchoolModel');
        if ($us->deleteSchool($id)) {
            $this->success("Rôle supprimé");
        } else {
            $this->error("Rôle non supprimé");
        }
        $this->redirect('/admin/userschool');
    }

    public function postSearchSchool()
    {
        $UserSchoolModel = model('UserSchoolModel');

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
        $data = $UserSchoolModel->getPaginatedSchool($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $UserSchoolModel->getTotalSchool();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $UserSchoolModel->getFilteredSchool($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function getdeactivate($id){
        $us = Model('UserSchoolModel');
        if ($us->deactivateSchool($id)) {
            $this->success("École désactivée");
        } else {
            $this->error("École non désactivée");
        }
        $this->redirect('/admin/userschool');
    }

    public function getactivate($id){
        $us = Model('UserSchoolModel');
        if ($us->activateSchool($id)) {
            $this->success("École activée");
        } else {
            $this->error("École non activée");
        }
        $this->redirect('/admin/userschool');
    }


}