<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/article">Topics</a></li>
            <li><a href="/home" id="title">BLOG</a></li>
            <li><a href="#">A propos</a></li>
            <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"]) : ?>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/login">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>


<section>
    <?= $html ?>
</section>

    <footer>

    </footer>

<script src="/assets/js/app.js"></script>
</body>
</html>
