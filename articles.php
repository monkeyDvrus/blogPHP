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
                            $categories = Db::getCategories();
                            foreach($categories as $categorie) :
                        ?>
                            <option <?php if($_GET[selectCategorie] == $categorie->id_categorie)echo 'selected'; ?> value="<?= $categorie->id_categorie ?>"><?= $categorie->nom_categorie ?></option>
                        <?php endforeach; ?>
                        <input type="submit" value="Filtrer">
                    </select>
                </form>
                <!-- *** Duplication *** -->
                <?php
                if($_GET[selectCategorie] <= count($categories)){
                    if(count($_GET[selectCategorie]) >= 1){
                        if($_GET[selectCategorie] == 0){
                            $articles = Db::getAllArticles();
                        } else {
                            $articles = Db::getArticlesByCategorrie($_GET[selectCategorie]);
                        };
                    } else if(count($_GET[selectCategorie]) == 0) {
                        $articles = Db::getAllArticles();
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
                }else{
                    echo '<div class="article"><h5>Catégorie non trouvé</h5></div>';
                }
                ?>
            </section>
        </main>

<?php
    getFooter();
?>