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
        try{
            InsertPostMedias();
        }catch (Exeption $e){
            print_rr($e);
        }
    ?>
    <body>
        <form action="post.php" method="post" enctype="multipart/form-data">
            <label for="commentaire">Commentaire :</label><br>
            <textarea type="text" id="commentaire" name="commentaire" cols="30" rows="10"></textarea> 
            <br>
            <label for="file">Image/Audio/Video :</label>
            <input type="file" id="file" name="file[]" multiple accept="audio/*,video/*,image/*">
            <br>
            <input type="submit" value="Envoyer"/>
        </form>
    </body>
</html>