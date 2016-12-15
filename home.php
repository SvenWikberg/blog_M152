<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <?php
        include_once("functions.inc.php");
        include_once("displayfunc.inc.php");
?>
    <header>
        <ul class="navbar navbar-default navbar-fixed-top">
            <li class="navbar-text"><a href="home.php">Home</a></li>
            <li class="navbar-text"><a href="post.php">Post</a></li>
        </ul>
    </header>
    <body style="padding-top: 70px;">
        <div>
            <img src="img/profile.png" alt="Profile">
            <h1>Bienvenue !</h1>
        </div>
        <section id="posts">
        <?php
            displayPosts();
        ?>
        </section>
        <script type="text/javascript">
            $('.confirmation').on('click', function () {
                return confirm('Are you sure?');
            });
        </script>
    </body>
</html>