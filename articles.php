<?php 
    require("./functions.php");
    require("./db.php"); 

    getHeader();
?>             

        <main>
            <section class="articlesAll">
                <h2>Tous les articles:</h2>
                <!-- *** Duplication *** -->
                <?php
                    $dbClass = new Db;
                    $articles = $dbClass->get_all_articles();
                    foreach ($articles as $article) :
                ?>
                    <!-- *** UN ARTICLE *** -->
                    <div class="article">
                        <header>
                            <h2><?= $article->titre_article ?></h2>
                        </header>
                        <div>
                            <p><span><?= $article->date_article ?></span></p>
                            <p><?= substr($article->texte_article, 0, 500) ?> ... <a href="./single.php?id=<?= $article->id_article ?>">Lire la suite</a></p>
                            <form>
                                <a href="./single.php?id=<?= $article->id_article ?>">
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