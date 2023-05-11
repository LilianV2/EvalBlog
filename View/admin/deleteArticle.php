<div class="listeArticle">
    <div class="listeMessage">
        <h1>Titre : <span><?= $params['article']->getTitle() ?></span></h1>
    </div>
    <hr>
    <div class="listeContent">
        <div id="displayArea">
            <form  style="width: 100%;" action="/articles/deleteArticle/<?= $params['article']->getId() ?>" method="post">
                <textarea name="areaText" id="areaText" cols="30" rows="10"><?= $params['article']->getContent() ?></textarea>
                <br>
                <input type="submit" id="deleteArea" value="Supprimer l'article">
            </form>
        </div>
    </div>
    <div class="listeFooter">
        <div>
            <h4>Auteur : <span><?= $params['article']->getAuthor()->getPseudo() ?></span></h4>
            <h4>ID : <span>#<?= $params['article']->getId() ?></span></h4>
        </div>
    </div>
</div>