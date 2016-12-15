<?php
    include_once("functions.inc.php");

    try{
        foreach(sqlSelectMediasByIdPost($_GET['id']) as $media){
            unlink('media/' . $media['nomFichierMedia']);
        }

        sqlDeletePostMediaByIdPost($_GET['id']);

        header('location: home.php');
    } catch (Exeption $e) {
        print_rr($e);
    }