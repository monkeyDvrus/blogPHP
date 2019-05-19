<?php 
    class Db{
        private $_conn;
        /**
         * Call at the construction of one instance
         */
        public function __construct(){
            $this->_conn = new PDO('mysql:host=localhost;dbname=blogPhp;charset=utf8;port=3306','root','',[]);
        }
        /**
         * Return all categories
         */
        public function getCategories(){
            $req = $this->_conn->prepare("SELECT * FROM `Categorie`");
            $req->execute();
            $categories = $req->fetchAll(PDO::FETCH_OBJ);
            return $categories;
        }
        /**
         * Return all articles
         */
        public function getAllArticles(){
            $req = $this->_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie;");
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return the last articles
         * $num is the number of articles wich must be return
         */
        public function getLastArticles($num){
            $numero = $num;
            $req = $this->_conn->prepare("SELECT * FROM `Article` ORDER BY `date_article` DESC LIMIT 0, $num;");
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return one article
         * $id is the primary key of the article wiwh must be return
         */
        public function getOneArticle($id){
            $req = $this->_conn->prepare("SELECT * FROM `Article` WHERE `id_article` = :id;");
            $req->bindParam(":id", $id);
            $req->execute();
            $article = $req->fetchAll(PDO::FETCH_OBJ);
            return $article;
        }
        /**
         * Return a list of articles wich add the categorie past in param
         */
        public function getArticlesByCategorrie($id){
            $req = $this->_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie WHERE Article.id_categorie = :id;");
            $req->bindParam(":id", $id);
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return a list of articles wich contain the word gived in param
         */
        public function searchTitle($search){
            $search = '%' . $search . '%';
            $req = $this->_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie WHERE Article.titre_article LIKE :search;");
            $req->bindParam(":search", $search);
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
    };
?>
