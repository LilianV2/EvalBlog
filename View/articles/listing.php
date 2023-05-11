<section class="article-container">
    <?php
    foreach ($params['article'] as $article) {
        /* @var User $user */ ?>
        <div>
            <div class="article-content">
                <h1><?= $article->getTitle() ?></h1>
                <hr>
                <p><?= $article->getContent() ?></p>
                <p class="smallcaps">Publié par <span class="italic"><?= $article->getAuthor()->getPseudo() ?></span></p>
                <hr>
                <a href="/articles/view/<?= $article->getId() ?>" class="modify">Modifier l'article</a>
                <a href="/articles/delete/<?= $article->getId() ?>" class="delete">Supprimer l'article</a>
            </div>
        </div>
        <?php
    } ?>
</section>