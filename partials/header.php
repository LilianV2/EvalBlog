<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Minichat</title>
</head>
<body>
<?php
session_start();
?>
<ul class="header">
    <?php
    if (!isset($_SESSION['user_id'])) {
        ?>
        <li class="menuButton"><a href="/login.php">Se connecter</a></li>
        <li class="title"><a href="/index.php">MiniChat</a></li>
        <li class="menuButton"><a href="/register.php">S'inscrire</a></li>
        <?php
    } else {
        ?>
        <li class="title"><a href="/index.php">MiniChat</a></li>
        <li class="menuButton"><a href="/disconnect.php">Se déconnecter</a></li>
        <?php
    }
    ?>
</ul>