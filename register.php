<?php
require 'partials/header.php';

require_once "DB.php";
use App\Model\DB;
?>

    <div class="formLogin">
        <h1>Inscrivez-vous pour chatter avec vos amis et plus encore !</h1>
        <hr>
        <form action="register.php" method="post">
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" maxlength="20" class="getInfo" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="getInfo" required>
            </div>
            <input type="submit" value="S'inscrire" class="formBtn">
        </form>
    </div>
    </body>
    </html>
<?php
require_once 'DB.php';
if ((!isset($_POST['username'])) && (!isset($_POST['password']))) {

} else {
    if (strlen($_POST['username']) > 15) {
        echo "Le nom d'utilisateur ne doit pas dépasser 15 charactères";
    }
    $sql = "INSERT INTO user (username, password)
                VALUES (:username, :password)";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header('location: login.php');
}

require 'partials/footer.php';