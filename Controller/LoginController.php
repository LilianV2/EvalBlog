<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\UserManager;

class LoginController extends AbstractController
{
    /**
     * Permet le listing de tous les articles.
     * @return void
     */
    public function index()
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            header("Location: /home");
        }
        else {
            $this->display('login/login');
        }
    }

    public function indexRegister()
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            header("Location: /home");
        }
        else {
            $this->display('login/register');
        }
    }

    public function logout()
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            $_SESSION["connected"] = false;
            $_SESSION = array();
            session_destroy();

            header('Location: /login');
            exit;
        }
        else {
            header("Location: /login");
        }
    }

    public function log()
    {
        $sql = "SELECT id, pseudo, password, email, is_admin FROM user WHERE email = :email";
        $req = DB::getInstance()->prepare($sql);

        $email = strip_tags($_POST['email_login'] ?? ''); // Supprime toutes les balises HTML potentiellement dangereuses
        $pass_form = strip_tags($_POST['password_login'] ?? ''); // Récupère le mot de passe entré dans le formulaire et supprime les balises HTML potentiellement dangereuses

        $req->bindParam(':email', $email);

        $pass_form = strip_tags($pass_form); // Supprime les balises HTML et PHP
        password_hash($pass_form, PASSWORD_BCRYPT); // Step 2 on le filtre

        if ($email && $pass_form) { // Check si les champs on était trouvé
            if ($req->execute()) {
                $userData = $req->fetch(); // Met notre $req en tableau associatif
                if (!empty($userData)) { // Va check si c'est vrai
                    if (password_verify($pass_form, $userData['password'])) { // Check si le mot de passe en clair > filtrer et égal aux mot de passe enregistrer dans la bdd
                        $id = $userData['id']; // Récupère l'ID de l'utilisateur

                        $_SESSION["connected"] = true;

                        $_SESSION["user"] = [
                            "name" => $userData['pseudo'],
                            "email" => $userData['email'],
                            "is_admin" => $userData['is_admin'],
                            "id_user" => $userData['id'],
                        ];

                        header("Location: /home");

                        echo("<div> Vous vous êtes login avec succès ! </div>");
                        echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 15000);</script>";

                    } else {
                        echo("<div> Mot de passe incorrect.. </div>");
                        $this->display('login/login');
                    }
                } else {
                    echo "<div> Aucun e-mail trouvé sous le nom : " . $email . "</div>";
                    $this->display('login/login');
                }
            } else {
                echo "<div> Aucun compte associé à ce nom d'utilisateur </div>";
                $this->display('login/login');
            }
        } else {
            echo "<div> Aucun champ trouvé..  </div>";
            $this->display('login/login');
        }
    }

    public function register()
    {
        {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                $username = strip_tags($_POST['username']);
                $user_email = strip_tags($_POST['email']);


                // Vérifier si l'email est valide
                $username = preg_replace('/[^a-zA-Z0-9]+/', '', strtr(trim($_POST['username']), 'àáâäãåçèéêëìíîïñòóôöõøùúûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy'));
                $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Filtrer l'adresse e-mail pour retirer les caractères spéciaux
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div> Cette adresse email n'est pas valide. </div>";
                    return;
                }

                if (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
                    echo "<div> Le nom d'utilisateur ne doit contenir que des caractères alphabétiques non accentués. </div>";
                    return;
                }

                // Vérifier si le nom d'utilisateur existe déjà
                $sql = "SELECT id FROM user WHERE pseudo = :username";
                $req = DB::getInstance()->prepare($sql);

                $req->bindParam(':username', $username);
                $req->execute();
                $result = $req->fetch();
                if ($result) {
                    echo "<div> Nom d'utilisateur déjà pris. </div>";
                    $this->display('login/register');
                    return;
                }

                // Vérifier si l'adresse email existe déjà
                $sql = "SELECT id FROM user WHERE email = :email";
                $req = DB::getInstance()->prepare($sql);

                $req->bindParam(':email', $user_email);
                $req->execute();
                $result = $req->fetch();
                if ($result) {
                    echo "<div> Cette adresse email est déjà utilisée. </div>";
                    return;
                }

                // Vérifier les deux mots de passe
                if ($_POST['password']){
                    $username = htmlspecialchars($_POST['username'], ENT_QUOTES); // Convertir les caractères spéciaux en entités HTML
                    // Les vérifications ont été passées, on peut ajouter l'utilisateur à la base de données
                    $pass = $_POST['password'];
                    $hash = password_hash($pass, PASSWORD_BCRYPT);


                    $sql = "INSERT INTO user (pseudo, password, email) VALUES (:username, :password, :email)";
                    $req = DB::getInstance()->prepare($sql);


                    $req->bindParam(':username', $username);
                    $req->bindParam(':password', $hash);
                    $req->bindParam(':email', $user_email);
                    $req->execute();

                    $this->display('home/index', [
                        'success' => "C'est ok"
                    ]);

                }
                else{
                    $this->display('login/login');
                }
            }
        }
    }
}