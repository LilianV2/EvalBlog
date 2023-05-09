<section class="article_container">
    <?php
    foreach($params['articles'] as $article) {
        /* @var User $user */ ?>
        <div class="article_item">
            <div class="info_article">
                <h1><?= $article->getTitle() ?></h1>
                <hr>
                <p><?= $article->getContent() ?></p>
                <p>Publié par <span class="italic"><?= $article->getAuthor()->getPseudo()?></span></p>
            </div>
        </div>
        <?php
    }
    ?>
</section>
