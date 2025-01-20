<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $require_auth = false;
    public function index(): string
    {
        return $this->view('front/dashboard/index');
    }

    public function getTournament()
    {
        $tournamentModel = model("TournamentModel") ;
        $tournaments = $tournamentModel->findAll();

        return view('tournament', ['tournaments' => $tournaments]);
    }

    public function getforbidden() : string
    {
        return view('/templates/forbidden');
    }
}
