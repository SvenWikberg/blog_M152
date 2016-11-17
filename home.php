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
            <h1>Bienvenue !</h1>
        </div>
        <section id="posts">
        <?php
            $posts = sqlSelectPosts();
            foreach($posts as $post){
                echo '<div style="border-style: solid; border-width: 1px;">';
                echo '<h2>' . $post['commentaire'] . '</h2>';
                $medias = sqlSelectMediasByIdPost($post['isPost']);
                foreach($medias as $media){
                    switch(explode('/',$media['typeMedia'])[0]) {
                        case "image":
                            echo '<img src="media/' . $media['nomFichierMedia'] . '" alt="">';
                        break;
                        case "audio":
                            echo '  <audio controls>
                                        <source src="media/' . $media['nomFichierMedia'] . '" type="' . $media['typeMedia'] . '">
                                    </audio>';
                        break;
                        case "video":
                            echo '  <video height="200" controls loop autoplay muted>
                                        <source src="media/' . $media['nomFichierMedia'] . '" type="' . $media['typeMedia'] . '">
                                    </video>';
                        break;
                    }
                }
                echo '</div><br>';
                
            }
        ?>
        </section>
        
    </body>
</html>