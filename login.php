<?php
require 'partials/header.php';
?>
    <div class="formLogin">
        <h1>Saisissez votre identifiant et mot-de-passe afin de pouvoir chatter !</h1>
        <hr>
        <form action="login.php" method="post">
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" class="getInfo" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="getInfo" required>
            </div>
            <input type="submit" value="Connexion" class="formBtn">
        </form>
    </div>

    </body>
    </html>

<?php
require_once 'DB.php';

use App\Model\DB;

require_once 'User.php';

if (!isset($_POST['username']) && !isset($_POST['password'])) {

} else {
    $sql = "SELECT * FROM user WHERE username = :username";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);


    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $user = (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setPassword($data['password']);

        if (password_verify($_POST['password'], $user->getPassword())) {

            $_SESSION['user_id'] = $user->getId();


            header('location: index.php');
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Utilisateur introuvable";
    }
}
require 'partials/footer.php';