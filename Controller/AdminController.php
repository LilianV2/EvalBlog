<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;

class AdminController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */
    public function index()
    {
        $this->display('admin/index');
    }

    public function pageCreateArticle()
    {
        $this->display('admin/article/create');
    }

    public function pageDeleteArticle()
    {
        $manager = new ArticleManager();
        $this->display('admin/deleteArticle', [
            'articles' => $manager->getAll(),
        ]);
    }

    public function viewModify($id)
    {
        $manager = new ArticleManager();
        $comment = new CommentManager();

        $article = $manager->getArticleById($id);
        $comments = $comment->getCommentById($id);

        $this->display('admin/modifyArticle', [
            'article' => $article,
            'comment' => $comments,
        ]);
    }

    public function createArticles()
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            // Vérifier que le formulaire a été soumis
            if (isset($_POST['create_content'])) {
                // Vérifier que tous les champs sont remplis
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $user_id = $_SESSION["user"]["id_user"];

                    // Ajouter l'article dans la base de données avec le numéro d'image
                    $sql = "INSERT INTO article (title, content, user_id) VALUES (:title, :content, :user_id)";
                    $req = DB::getInstance()->prepare($sql);

                    $req->bindParam(':title', $title);
                    $req->bindParam(':content', $content);
                    $req->bindParam(':user_id', $user_id);

                    $req->execute();
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                echo "erreur";
            }
        }

        header('Location: /login');
    }

    public function modifyArticle($id)
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            $article_id = $id;
            $article_content = $_POST['areaText'];

            $sql = "UPDATE article SET content = :article_content WHERE id= :article_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':article_id', $article_id);
            $req->bindParam(':article_content', $article_content);

            $req->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "<div class='warning'>Vous n'êtes pas login..</div>";
            $this->display('login/login');
        }
    }

    public function deleteArticle($id)
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            $article_id = $id;

            $sql = "DELETE FROM article WHERE id= :article_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':article_id', $article_id);

            $req->execute();
            header('Location: /articles');

        } else {

            //Utiliser JavaScript pour masquer le message d'avertissement après quelques secondes
            echo '<script>setTimeout(function(){ document.querySelector(".warning").style.display = "none"; }, 4000);</script>';
            // Afficher le formulaire de connexion
            $this->display("login/login");
        }
    }
}
