<div id="container">
    <section class="home">
        <div>
            <h1>Bienvenue sur le BLOG</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At delectus fugiat iure magni nobis nostrum
                voluptates, voluptatibus.
            </p>
        </div>
        <div class="home-img">images</div>
    </section>
    <section class="info-home">
        <div class="info-home-cards">
            <div class="info-cards">
                <h2>Article 1</h2>
                <p>publié par <i class="fa-solid fa-user"></i> ###</p>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis dignissimos ea eaque enim
                    error facilis fugiat incidunt laborum molestias quia quo, sed vel velit veniam vero voluptatem?
                    Ducimus, quo?</p>
            </div>
            <div class="info-cards">
                <h2>Article 2</h2>
                <p>publié par <i class="fa-solid fa-user"></i> ###</p>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis dignissimos ea eaque enim
                    error facilis fugiat incidunt laborum molestias quia quo, sed vel velit veniam vero voluptatem?
                    Ducimus, quo?</p>
            </div>
            <div class="info-cards">
                <h2>Article 3</h2>
                <p>publié par <i class="fa-solid fa-user"></i> ###</p>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis dignissimos ea eaque enim
                    error facilis fugiat incidunt laborum molestias quia quo, sed vel velit veniam vero voluptatem?
                    Ducimus, quo?</p>
            </div>
            <div class="info-cards">
                <h2>Article 4</h2>
                <p>publié par <i class="fa-solid fa-user"></i> ###</p>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis dignissimos ea eaque enim
                    error facilis fugiat incidunt laborum molestias quia quo, sed vel velit veniam vero voluptatem?
                    Ducimus, quo?</p>
            </div>
        </div>
    </section>
    <section class="home-contact">
        <h1>Vos articles n'attendent qu'à être écrits !</h1>
        <p>Envie de publier un article ? C'est très simple, cliquez sur le bouton ci-dessous, et libre à vous de vous
            exprimer !</p>
        <button id="create-article-btn">Publier un article</button>
        <form action="/articles/createArticles" class="create-article" method="post">
            <label for="title">Sujet de l'article</label>
            <input type="text" name="title" id="title">
            <hr>
            <label for="content">Contenu</label>
            <textarea name="content" id="content" placeholder="A vos clavier !" rows='7' data-min-rows='7'></textarea>
            <input type="submit" value="Valider mon article" class="send-article" name="create_content">
            <button id="close-btn">Fermer</button>
        </form>
    </section>
    <footer>
        <section class="last-footer">
            <p>&copy; 2020 Wirefigma</p>
            <p>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-instagram"></i>
            </p>
            <p>
                Conditions générales de vente
            </p>
        </section>
    </footer>
</div>