<?php
    require("../Model/acessaBD.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(confereCadastro($username, $password)){
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location:'.'../perfil.php');
        die(); 
    }else{ 
        header('Location:'.'../index.php', true, 404);
        die();
        
    }

    ?>