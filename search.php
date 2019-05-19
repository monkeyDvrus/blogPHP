<?php 
    require("./functions.php");
    require("./db.php"); 

    getHeader();
?>             

        <main>
            <section class="articlesAll">
            <?php
                $dbClass = new Db;
                $articles = $dbClass->searchTitle($_POST['search']);
                if(!count($articles) == 0){
                foreach($articles as $article) :
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
            } else {
                echo '<div class="article"><h5>Aucun article trouvé</h5></div>';
            }
            ?>
            </section>
        </main>

<?php
    getFooter();
?>