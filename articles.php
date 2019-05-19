<?php 
    require("./functions.php");
    require("./db.php"); 

    getHeader();
?>             

        <main>
            <section class="articlesAll">
                <h2>Tous les articles:</h2>
                <form action="./articles.php?id=<?php $_GET->selectCategorie ?>" method="GET">
                    <select name="selectCategorie">
                        <option value="0">Toutes les catégories</option>
                        <?php
                            $dbClass = new Db;
                            $categories = $dbClass->getCategories();
                            foreach($categories as $categorie) :
                        ?>
                            <option <?php if($_GET[selectCategorie] == $categorie->id_categorie)echo 'selected'; ?> value="<?= $categorie->id_categorie ?>"><?= $categorie->nom_categorie ?></option>
                        <?php endforeach; ?>
                        <input type="submit" value="Filtrer">
                    </select>
                </form>
                <!-- *** Duplication *** -->
                <?php
                    if(count($_GET[selectCategorie]) >= 1){
                        if($_GET[selectCategorie] == 0){
                            $articles = $dbClass->getAllArticles();
                        } else {
                            $articles = $dbClass->getArticlesByCategorrie($_GET[selectCategorie]);
                        };
                    } else if(count($_GET[selectCategorie]) == 0) {
                        $articles = $dbClass->getAllArticles();
                    };
                    foreach ($articles as $article) :
                ?>
                    <!-- *** UN ARTICLE *** -->
                    <div class="article">
                        <header>
                            <h2><?= $article->titre_article ?></h2>
                        </header>
                        <div>
                            <h5>⦕<?= $article->nom_categorie ?></h5>
                            <p><span><?= $article->date_article ?></span></p>
                            <p><?= substr($article->texte_article, 0, 500) ?> ... <a href="./article.php?id=<?= $article->id_article ?>">Lire la suite</a></p>
                            <form>
                                <a href="./article.php?id=<?= $article->id_article ?>">
                                    <input type="button" class="btn btn-outline-primary my-2 my-sm-0" value="Lire l'article">
                                </a>
                            </form>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </section>
        </main>

<?php
    getFooter();
?>