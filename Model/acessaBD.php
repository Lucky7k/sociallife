<?php

    require '../config.php';

    try{
        $conexao = new PDO("mysql:host=$host; dbname=$db",
        $user, $password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Conexão falhou: " . $e->getMessage();
    }

    function insereNovoUsuario($username,$password,$email,$dtnasc, $foto){
        global $conexao;

        if($username == null || $password == null || $dtnasc == null || $email == null){
            return false;
        }

        $query = $conexao->query("SELECT username FROM user
         WHERE username = '$username'");
         if ($query->rowCount()>0){
            echo "Nome de usuário já usado";
            return false;
         }

         $query = $conexao->query("SELECT username FROM user
         WHERE email = '$email'");
         if ($query->rowCount()>0){
            echo "Email já usado";
            return false;
    }
    $stm = $conexao->prepare
    ("INSERT INTO user(username, password, email, dtNasc, foto)
    VALUES (:username, :password, :email, :dtNasc, :foto) ");

    $stm->bindParam(':username', $username);
    $stm->bindParam(':password', $password);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':dtNasc', $dtnasc);
    $stm->bindParam(':foto', $foto);

    $stm->execute();

    echo "Cadastro realizado com sucesso";
    return true;
}

function insereNovoPost($username, $post){ 
    global $conexao;

    $stm = $conexao->prepare
    ("INSERT INTO feed (usernameCreator, text)
    VALUES (:username, :text)");

    $stm->bindParam(':username', $username);
    $stm->bindParam(':text', $post);

    $stm->execute();

    echo "Post realizado com sucesso!";
    return true;
}

function confereCadastro($username, $password){
    global $conexao;
    $query = $conexao->query("SELECT username, password
    FROM user WHERE username='$username' AND password='$password'");
    return ($query->rowCount()>0);
}

function retornaDadosDoPerfil($username, $password){
    global $conexao;
    $dadosPerfil="sem dados";
    $query = $conexao->query("SELECT * FROM user 
    WHERE username='$username' AND password='$password'");
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        $dadosPerfil = array(
            "username"=>$row->username,
            "email"=>$row->email,
            "dtNasc"=>$row->dtNasc,
            "foto"=>$row->foto
        );
    }
    return $dadosPerfil;
}

function exibeTodos($username, $password){
    global $conexao;
    $query = $conexao->query("SELECT * FROM user
    WHERE username!='$username' OR password!='$password'");
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        list($ano, $mes, $dia) = explode('-', $row->dtNasc);
        echo "<div class='flex horizontal'>";
        echo "<img src='imagens/$row->foto' class='foto'/>";
        echo "<div id='conteudo'>$row->username - $row->email <br>
        Data de Nascimento: $dia/$mes/$ano</div>";
        echo "</div>";
    }
}

function exibePosts(){
    global $conexao;
    $query = $conexao->query("SELECT * FROM feed ORDER BY dateTime DESC;");
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        $date = date_create($row->dateTime);
        $date = date_format($date, 'd/m/Y H:i:s');
        echo "<div class='flex vertical post'>";
        echo "<div class='flex horizontal'>";
        echo "<b style= 'padding-right: 10px'>$row->usernameCreator</b>
        <i style='font-size: smaller;'>$date </i></div>";
        echo "<p>$row->text</p>";
        echo "</div>";
    }
}

?>