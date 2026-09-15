<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        require_once APP_DIR . 'libraries/LabDatabaseSetup.php';
        LabDatabaseSetup::ensure($this->db);
        $this->call->model('UsersModel');
    }

    public function index()
    {
        $users = $this->UsersModel->all();

        $this->call->view('users/index', [
            'title' => 'Prince Lawrence Dimaapi - Users',
            'users' => $users,
        ]);
    }
}
