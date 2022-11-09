<?php
    require("../Model/acessaBD.php");
    session_start();
    $username = $_SESSION['username'];
    $post = $_POST['post'];
    if(insereNovoPost($username, $post)){
        header('Location:'.'../feed.php');
        die();
    }else{
        header('Location:'.'../feed.php', true, 404);
        die();

    }
?>