<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $title      = 'Tableau de Bord';
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur','utilisateur'];

    public function getindex(): string
    {
        $um = Model("App\Models\UserModel");
        $infosUser = $um->countUserByPermission();
        return $this->view('front/dashboard/index', ['infosUser' => $infosUser], true);

    }

    public function getforbidden() : string
    {
        return view('/templates/forbidden');
    }
}