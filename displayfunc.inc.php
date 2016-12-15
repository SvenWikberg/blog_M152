<?php
    include_once("functions.inc.php");

    function displayPosts(){
        $posts = sqlSelectPosts();
        foreach($posts as $post){
            echo '<div class="container" style="border-style: solid; border-width: 1px;"><a class="confirmation" href="delete.func.php?id=' . $post['idPost'] . '">delete</a>';
            echo '<h2>' . $post['commentaire'] . '</h2>';
            $medias = sqlSelectMediasByIdPost($post['idPost']);
            foreach($medias as $media){
                switch(explode('/',$media['typeMedia'])[0]) {
                    case "image":
                        echo ' <!--<figure>--><img style="width: 30%;" src="media/' . $media['nomFichierMedia'] . '" alt=""><!--</figure>-->';
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
    }