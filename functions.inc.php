<?php
    function &bddPdo() {
        $myPdo = null;

        try {
            if ($myPdo == null) {
                $myBdd = new PDO('mysql:host=127.0.0.1;dbname=blog_m152', 'wikbergs', '1234', array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_PERSISTENT => true));
                return $myBdd;
            }
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex;
        }
    }

    function sqlInsertPosts($commentaire) {
        $myPDO = bddPdo();

        try{
            $req = $myPDO->prepare("INSERT INTO posts VALUES(NULL, :commentaire, NOW());");
            $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            print_r($e);
        }
    }

    function sqlInsertMedias($typeMedia, $nomMedia, $idPost) {
        $myPDO = bddPdo();

        try{
            $req = $myPDO->prepare("INSERT INTO medias VALUES(NULL, :nomMedia, :typeMedia, :idPost);");
            $req->bindParam(':nomMedia', $nomMedia, PDO::PARAM_STR);
            $req->bindParam(':typeMedia', $typeMedia, PDO::PARAM_STR);
            $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
            $req->execute();
        } catch (Exception $e) {
            print_r($e);
        }
    }

    function sqlSelectMediasByIdPost($id){
        $myPDO = bddPdo();
        $req = $myPDO->prepare("SELECT * FROM medias WHERE idPost = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectPosts(){
        $myPDO = bddPdo();
        $req = $myPDO->prepare("SELECT * FROM posts");
        $req->execute();
        return $req->fetchAll();
    }

    function print_rr($item){
        echo '<pre>';
        print_r($item);
        echo '</pre>';
    }