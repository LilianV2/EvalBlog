<section class="article-container">
    <?php
    foreach ($params['article'] as $article) {
        /* @var User $user */ ?>
        <div>
            <div class="article-content">
                <h1><?= $article->getTitle() ?></h1>
                <hr>
                <p><?= $article->getContent() ?></p>
                <p><?= $article->getAuthor()->getPseudo() ?></p>
                <a href="/articles/view/<?= $article->getId() ?>">Modifier l'article</a>
            </div>
        </div>
        <?php
    } ?>
</section>