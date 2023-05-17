<?php
require_once 'partials/header.php';
if (isset($_SESSION['user_id'])) {
    //Do not display the message creation field if the user is not authenticated
    ?>
    <form action="sendMessage.php" method="post">
        <input name="message" id="message" maxlength="500" class="card setMessage" placeholder="Saisissez votre message" required>
        <input type="submit" value="Envoyer" class="card cardBtn">
    </form>
    <?php
}
require_once 'DB.php';
require_once 'Message.php';
require_once 'User.php';

if (isset($_SESSION['user_id'])) {
    $messages = new Message();
    $messages = $messages->getAll50();

    foreach ($messages as $message) {
        /* @var Message $message */
        $author = (new User())->getUserById($message->getAuthorId());
        /* @var User $author */
        ?>
        <div class="card displayFlex">
            <p class="content"> De <?= $author->getUsername() . " : <br><br>" . $message->getContent() ?></p>
            <p class="time">Le : <span><?= $message->getTimestamp() ?></span></p>
        </div>
        <?php
    }
} else {
    ?>
    <div class="main">
        <h1>Bievenue sur le MiniChat en ligne</h1>
        <hr>
        <p>
            Bienvenue sur notre tout nouveau Chat en ligne ! Discuter avec vos amis, votre famille ou de
            nouvelles connaissances n'a jamais été aussi simple et amusant. Connectez-vous à tout moment
            et de n'importe où à travers le monde pour rencontrer des personnes partageant les mêmes
            centres d'intérêt que vous. Notre Chat en ligne est doté d'une interface conviviale et facile
            à utiliser, vous permettant de discuter en temps réel, partager des photos, des vidéos et des
            émoticônes pour exprimer vos émotions et vous amuser. Rejoignez notre communauté dès maintenant
            et commencez à établir de nouvelles relations et à découvrir de nouveaux horizons.
        </p>
    </div>
    <?php
    $messages = new Message();
    $messages = $messages->getAll50();

    foreach ($messages as $message) {
        /* @var Message $message */
        $author = (new User())->getUserById($message->getAuthorId());
        /* @var User $author */
        ?>
        <div class="card displayNone">
            <p class="content"> De <?= $author->getUsername() . " : <br><br>" . $message->getContent() ?></p>
            <p class="time">Le : <span><?= $message->getTimestamp() ?></span></p>
        </div>
        <?php
    }
}
?>

<?php

require 'partials/footer.php';
?>
<script src="assets/app.js"></script>