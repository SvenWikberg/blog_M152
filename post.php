<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <?php
        include_once("functions.inc.php");
    ?>
    <header>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="post.php">Post</a></li>
        </ul>
    </header>
    <?php
    if(!empty($_POST)){


        //print_rr($_FILES);

        $commentaire = $_POST['commentaire'];

        sqlInsertPosts($commentaire);
        $idPost = bddPDO()->lastInsertId();


        for ($i = 0; $i < count($_FILES['file']['name']) ; $i++) {

            $tmp = sha1($_FILES['file']['name'][$i] . getdate()[0]);
            $extension = explode('/',$_FILES['file']['type'][$i])[1];
            $fileName = $tmp . '.' . $extension;

            move_uploaded_file($_FILES['file']['tmp_name'][$i], 'media/' . $fileName);
            sqlInsertMedias($_FILES['file']['type'][$i], $fileName, $idPost);
        }
        
        header('location: home.php');
    }
    ?>
    <body>
        <form action="post.php" method="post" enctype="multipart/form-data">
            <label for="commentaire">Commentaire :</label><br>
            <textarea type="text" id="commentaire" name="commentaire" cols="30" rows="10"></textarea> 
            <br>
            <label for="image">Image :</label>
            <input type="file" id="file" name="file[]" multiple accept="audio/*,video/*,image/*">
            <br>
            <input type="submit" value="Envoyer"/>
        </form>
    </body>
</html>