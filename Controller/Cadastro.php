<html>
    <?php
        require("../Model/acessaBD.php");
        $fotos="";
        if(isset($_FILES['foto'])){
            $ext = strtolower(substr($_FILES['foto']['name'],-4));
            $foto = $_POST['username'].date("Y.m.d.H-i-s").$ext;
        }
        if(insereNovoUsuario($_POST['username'], $_POST['password'],
        $_POST['email'], $_POST['date'], $foto)){ 
            $dir = '../imagens/';
            move_uploaded_file($_FILES['foto']['tmp_name'],$dir.$foto);
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('Location:'.'../index.php');
            die(); 
        }else{
            echo "<br><br>Erro no cadastro.";
            echo "<form action='../index.php' method='post'>";
            echo "<input type='submit' class'btn btn-light' values='Tentar novamente>";
            echo "</form>";
        }
    ?>
</html>