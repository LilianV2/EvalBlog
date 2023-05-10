<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;
use App\Model\Manager\UserManager;

class ArticlesController extends AbstractController
{
    public function view($id)
    {
        $manager = new ArticleManager();
        $comment = new CommentManager();

        $article = $manager->getArticleById($id);
        $comments = $comment->getCommentById($id);

        $this->display('articles/listing', [
            'article' => $article,
            'comment' => $comments,
        ]);
    }

    public function sendMessage($id)
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            if (isset($_POST['comment'])) {
                $message = htmlspecialchars($_POST['comment']);

                $user_id = $_SESSION["user"]["id_user"];

                $article_id = $id;

                $sql = "INSERT INTO article (user_id, message, article_id) VALUES (:pseudo, :message, :article_id)";
                $req = DB::getInstance()->prepare($sql);

                $req->bindParam(':pseudo', $user_id);
                $req->bindParam(':message', $message);
                $req->bindParam(':article_id', $article_id);

                $req->execute();
                header('Location: ' . $_SERVER['HTTP_REFERER']);



            } else {
                echo "<div class='warning'> Mot de passe non identique. </div>";
                $this->display('login/login');
            }
        }
        else {
            echo "<div class='warning'> PAS CONNECTER </div>";
            $this->display('login/login');
        }
    }
}