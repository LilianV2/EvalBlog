<?php
require_once 'partials/header.php';
if (isset($_SESSION['user_id'])) {
    //Do not display the message creation field if the user is not authenticated
    ?>
    <form action="sendMessage.php" method="post">
        <input name="message" id="message" maxlength="50" class="card setMessage" required>
        <input type="submit" value="Envoyer" class="card cardBtn">
    </form>

    <?php
}
require_once 'DB.php';
require_once 'Message.php';
require_once 'User.php';

$messages = new Message();
$messages = $messages->getAll50();
foreach ($messages as $message) {
    /* @var Message $message */
    $author = (new User())->getUserById($message->getAuthorId());
    /* @var User $author */
    ?>
    <div class="card">
        <p class="content"> De <?=$author->getUsername() . " : <br><br>" . $message->getContent() ?></p>
        <p class="time">Le : <span><?= $message->getTimestamp() ?></span></p>
    </div>

    <?php
}
require 'partials/footer.php';
?>
<script src="assets/app.js"></script>