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
            $req = $this->_conn->prepare("SELECT * FROM `Article`");
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return the last articles
         * $num is the number of articles wich must be return
         */
        public function getLastArticles($num){
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
            $req = $this->_conn->prepare("SELECT * FROM `Article` WHERE `id_article` = $id;");
            $req->execute();
            $article = $req->fetchAll(PDO::FETCH_OBJ);
            return $article;
        }
    };
?>
