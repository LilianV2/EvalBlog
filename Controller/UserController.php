<?php

namespace App\Controller;

use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */
    public function index()
    {
        $manager = new UserManager();
        $this->display('user/listing', [
            'users' => $manager->getAll()
        ]);
    }
}
