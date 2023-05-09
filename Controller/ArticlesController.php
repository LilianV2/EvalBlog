<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticleManager;
//use App\Model\Manager\CommentManager;
use App\Model\Manager\UserManager;

class ArticlesController extends AbstractController
{
    /**
     * Permet le listing de tous les articles.
     * @return void
     */
    public function index()
    {
        $manager = new ArticleManager();
        $this->display('articles/listing', [
            'articles' => $manager->getAll()
        ]);
    }
}