<html>
<?php
    if(isset($_SESSION['username'])){
        session_destroy();
    }
    if(isset($_COOKIE['autenticacao'])){
        setcookie("autenticacao","", time()-60, "/"); 
    }
    header('Location: ../index.php');
    exit();
?>
</html>