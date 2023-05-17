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
        $sql = "SELECT id, pseudo, password, email FROM user WHERE email = :email";
        $req = DB::getInstance()->prepare($sql);

        $email = strip_tags($_POST['email'] ?? ''); // delete HTML tags
        $pass_form = strip_tags($_POST['password'] ?? ''); // get password and delete HTML tags

        $req->bindParam(':email', $email);

        $pass_form = strip_tags($pass_form); // delete HTML and PHP tags
        password_hash($pass_form, PASSWORD_BCRYPT);

        if ($email && $pass_form) {
            if ($req->execute()) {
                $userData = $req->fetch(); // make the request into an array
                if (!empty($userData)) {
                    if (password_verify($pass_form, $userData['password'])) { // check if the password equals to the one in the db
                        $id = $userData['id']; // get user ID

                        $_SESSION["connected"] = true;

                        $_SESSION["user"] = [
                            "name" => $userData['pseudo'],
                            "email" => $userData['email'],
                            "id_user" => $userData['id'],
                        ];

                        header("Location: /home");

                        echo("<div> Vous vous êtes login avec succès ! </div>");
                    } else {
                        echo("<div> Mot de passe incorrect </div>");
                        $this->display('login/login');
                    }
                } else {
                    echo "<div> Aucun e-mail trouvé sous le nom : " . $email . "</div>";
                    $this->display('login/login');
                }
            } else {
                echo "<div> Utilisateur introuvable </div>";
                $this->display('login/login');
            }
        } else {
            echo "<div> Veuillez remplir les champs  </div>";
            $this->display('login/login');
        }
    }

    public function register()
    {
        {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                $username = strip_tags($_POST['username']);
                $user_email = strip_tags($_POST['email']);

                // check if the email is ok
                $username = preg_replace('/[^a-zA-Z0-9]+/', '', strtr(trim($_POST['username']), 'àáâäãåçèéêëìíîïñòóôöõøùúûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy'));
                $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // filter html chars
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div> Cette adresse email n'est pas valide. </div>";
                    return;
                }

                if (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
                    echo "<div> Le nom d'utilisateur ne doit contenir que des caractères alphabétiques non accentués. </div>";
                    return;
                }

                // check if the user already exists
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

                // check if the email already exists
                $sql = "SELECT id FROM user WHERE email = :email";
                $req = DB::getInstance()->prepare($sql);

                $req->bindParam(':email', $user_email);
                $req->execute();
                $result = $req->fetch();
                if ($result) {
                    echo "<div> Cette adresse email est déjà utilisée. </div>";
                    return;
                }

                // check password
                if ($_POST['password']){
                    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
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