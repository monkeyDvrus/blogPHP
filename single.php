<?php 
    require("./functions.php");
    require("db.php"); 

    getHeader();
?>     

        <main>
            <!-- *** UN ARTICLE *** -->
            <div class="article single">
            <?php
                $dbClass = new Db;
                $article = $dbClass->getOneArticle($_GET[id]);
                echo '<header><h2>'.$article[0]->titre_article.'</h2></header>';
                echo '<div><p><span>'.$article[0]->date_article.'</span></p>';
                echo '<p>'.$article[0]->texte_article.'</p></div>';
            ?>
            </div>
        </main>

<?php
    getFooter();
?>