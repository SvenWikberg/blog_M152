<?php
    function &bddPdo() {
        $myPdo = null;

        try {
            if ($myPdo == null) {
                $myBdd = new PDO('mysql:host=127.0.0.1;dbname=blog_m152', 'wikbergs', '1234', array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_PERSISTENT => true));
                $myBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $myBdd;
            }
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex;
        }
    }

    function sqlInsertPosts($commentaire, $bddPDO) {
        $myPDO = $bddPDO;

        try{
           //$myPDO->beginTransaction();
            $req = $myPDO->prepare("INSERT INTO posts VALUES(NULL, :commentaire, NOW());");
            $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
            $req->execute();
           // $myPDO->commit();
        } catch (Exception $e) {
            print_rr($e);
        }
    }

    function sqlInsertMedias($typeMedia, $nomMedia, $idPost, $bddPDO) {
        $myPDO = $bddPDO;

        try{
           // $myPDO->beginTransaction();
            $req = $myPDO->prepare("INSERT INTO medias VALUES(NULL, :nomMedia, :typeMedia, :idPost);");
            $req->bindParam(':nomMedia', $nomMedia, PDO::PARAM_STR);
            $req->bindParam(':typeMedia', $typeMedia, PDO::PARAM_STR);
            $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
            $req->execute();
            //$myPDO->commit();
        } catch (Exception $e) {
            //print_rr($e);
        }
    }

    function sqlSelectMediasByIdPost($id){
        $myPDO = bddPdo();
        $req = $myPDO->prepare("SELECT * FROM medias WHERE idPost = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlDeletePostMediaByIdPost($id){
        try{
            $myPDO = bddPdo();

            $myPDO->beginTransaction();

            $req = $myPDO->prepare("DELETE FROM medias WHERE idPost = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $req = $myPDO->prepare("DELETE FROM posts WHERE idPost = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $myPDO->commit();
        } catch (Exeption $e) {
            print_rr($e);
        }
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

    function testIfImageVideoAudio($files){
        $check = true;
        foreach($files['file']['type'] as $type){
            $typeFiles = explode('/',$type)[0];
            if($typeFiles == 'image' || $typeFiles == 'video' || $typeFiles == 'audio'){
                
            } else {
                $check = false;
            }
        }
        return $check;
    }

    function InsertPostMedias(){
        if(!empty($_POST)){
            $isError = false; 
            foreach($_FILES['file']['error'] as $error){
                if($error == 1)
                $isError = true;
            }



            if(!$isError && testIfImageVideoAudio($_FILES)){
                $myPDO = bddPdo();
                $commentaire = $_POST['commentaire'];

                $myPDO->beginTransaction();  
                try{
                    sqlInsertPosts($commentaire, $myPDO);
                }catch (Exeption $e){
                    //print_rr($e);
                }

                $idPost = $myPDO->lastInsertId();

                for ($i = 0; $i < count($_FILES['file']['name']) ; $i++) {
                    $extension = explode('/',$_FILES['file']['type'][$i])[1];

                    if($extension == 'mp3' || $extension == 'ogg' || $extension == 'wav' || $extension == 'mp4' || $extension == 'webm' || $extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif'){
                        $bonFichier = true;
                    } else {
                        $bonFichier = false;
                    }
                }

                for ($i = 0; $i < count($_FILES['file']['name']) ; $i++) {

                    $tmp = sha1($_FILES['file']['name'][$i] . getdate()[0]);
                    $extension = explode('/',$_FILES['file']['type'][$i])[1];
                    $fileName = $tmp . '.' . $extension;

                    move_uploaded_file($_FILES['file']['tmp_name'][$i], 'media/' . $fileName);
                    sqlInsertMedias($_FILES['file']['type'][$i], $fileName, $idPost, $myPDO);
                    }
                $myPDO->commit();  
                print_rr($_FILES);
                header('location: home.php');
            } else {
                echo '<h1>Error</h1>';
            }
        }
    }