<?php 
    class Db{
        private static $_conn;
        /**
         * Call at the construction of one instance
         */
        private static function getPDO(){
            self::$_conn = new PDO('mysql:host=localhost;dbname=blogPHP;charset=utf8;port=3306','phpmyadmin','root',[]);
        }
        /**
         * Return all categories
         */
        public static function getCategories(){
            self::getPDO();
            $req = self::$_conn->prepare("SELECT * FROM `Categorie`");
            $req->execute();
            $categories = $req->fetchAll(PDO::FETCH_OBJ);
            return $categories;
        }
        /**
         * Return all articles
         */
        public static function getAllArticles(){
            self::getPDO();
            $req = self::$_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie;");
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return the last articles
         * $num is the number of articles wich must be return
         */
        public static function getLastArticles($num){
            self::getPDO();
            $numero = $num;
            $req = self::$_conn->prepare("SELECT * FROM `Article` ORDER BY `date_article` DESC LIMIT 0, $numero;");
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return one article
         * $id is the primary key of the article wiwh must be return
         */
        public static function getOneArticle($id){
            self::getPDO();
            $req = self::$_conn->prepare("SELECT * FROM `Article` WHERE `id_article` = :id;");
            $req->bindParam(":id", $id);
            $req->execute();
            $article = $req->fetchAll(PDO::FETCH_OBJ);
            return $article;
        }
        /**
         * Return a list of articles wich add the categorie past in param
         */
        public static function getArticlesByCategorrie($id){
            self::getPDO();
            $req = self::$_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie WHERE Article.id_categorie = :id;");
            $req->bindParam(":id", $id);
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
        /**
         * Return a list of articles wich contain the word gived in param
         */
        public static function searchTitle($search){
            self::getPDO();
            $search = '%' . $search . '%';
            $req = self::$_conn->prepare("SELECT * FROM Article JOIN Categorie ON Article.id_categorie = Categorie.id_categorie WHERE Article.titre_article LIKE :search;");
            $req->bindParam(":search", $search);
            $req->execute();
            $articles = $req->fetchAll(PDO::FETCH_OBJ);
            return $articles;
        }
    }