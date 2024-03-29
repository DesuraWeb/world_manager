<?php
defined('BASEPATH') or exit('No direct script access allowed');

class World_manager extends AdminController
{
    public function index()
    {
        $this->load->view('world_manager_view', [
            'title' => 'World Manager'
        ]);
    }
    
    public function list_account()
    {
        // Votre code pour afficher la page de création de compte
        $this->load->view('list_account');
    }
    
    public function create_account()
    {
        // Votre code pour afficher la page de création de compte
        $this->load->view('create_account');
    }
}
