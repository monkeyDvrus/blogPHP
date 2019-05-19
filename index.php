<?php require "functions.php"; ?>
<?php require "db.php"; ?>

<?php getHeader(); ?>       

        <main>
            <section class="articles">
                <h2>Les derniers articles:</h2>
                <!-- *** DUPLICATION *** -->
                <?php
                    $dbClass = new Db;
                    $articles = $dbClass->getLastArticles(5);
                    foreach ($articles as $article) :
                ?>
                    <!-- *** UN ARTICLE *** -->
                    <div class="article">
                        <header>
                            <h2><?= $article->titre_article ?></h2>
                        </header>
                        <div>
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
            <!-- *** SIDE BAR *** -->
            <section class="sidebar">
                <header>
                    <h3>Les hot catégories</h3>
                </header>
                <div>
                    <ul>
                        <!-- *** AJOUTE LES CATEGORIES *** -->
                        <?php
                            $categories = $dbClass->getCategories();
                            foreach ($categories as $categorie) :
                        ?>
                            <li><a href="./articles.php?selectCategorie=<?= $categorie->id_categorie ?>"><?= $categorie->nom_categorie; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        </main>

<?php getFooter(); ?>