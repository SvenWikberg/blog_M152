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
            $myPDO->query("INSERT INTO posts VALUES(NULL, \"$commentaire\", NOW());");
        } catch (Exception $e) {
            print_r($e);
        }
    }

    function sqlInsertMedias($typeMedia, $nomMedia, $idPost) {
        $myPDO = bddPdo();

        try{
            $myPDO->query('INSERT INTO medias VALUES(NULL, "' . $nomMedia . '", "' . $typeMedia . '", ' . $idPost . ');');
        } catch (Exception $e) {
            print_r($e);
        }
    }
    function sqlSelectMedias(){
    $myPDO = bddPdo();
    $reqArray = $myPDO->query('SELECT * FROM medias')->fetchAll();
    return $reqArray;
}