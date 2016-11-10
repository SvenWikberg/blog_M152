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

        $commentaire = $_POST['commentaire'];

        sqlInsertPosts($commentaire);
        $idPost = bddPDO()->lastInsertId();

        for ($i = 0; $i < count($_FILES['image']['name']) ; $i++) {
            move_uploaded_file($_FILES['image']['tmp_name'][$i], 'media/' . $_FILES['image']['name'][$i]);
            sqlInsertMedias($_FILES['image']['type'][$i], $_FILES['image']['name'][$i], $idPost);
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
            <input type="file" id="image" name="image[]" multiple accept="image/*">
            <br>
            <input type="submit" value="Envoyer"/>
        </form>
    </body>
</html>