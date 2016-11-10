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
    <body>
        <div>
            <img src="img/profile.png" alt="Profile">
            <p>Bienvenue !</p>
        </div>
        <section id="posts">
        <?php

            $posts = sqlSelectMedias();

            foreach($posts as $post){
                echo '<img src="media/' . $post['nomFichierMedia'] . '" alt="">';
            }
        ?>
        </section>
    </body>
</html>