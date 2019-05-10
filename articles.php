<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/media.css">
        <title>Blog PHP ARTICLES</title>
    </head>

    <body>
        <?php include("./menu.php") ?>          

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

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>