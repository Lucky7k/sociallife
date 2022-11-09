<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fundo">
    <div class="flex horizontal center">
        <div class="flex vertical center box card">
            <h1>Crie sua conta</h1>
            <form class="flex vertical" id="formCadastro" method="post"
            action="Controller/Cadastro.php" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Nome de usuário">
            <input type="password" name="password" id= "password" placeholder="Senha">
            <input type="email" name="email" id= "email" placeholder="Email">
            <input type="date" name="date" id= "date" placeholder="Data de nascimento">
            <div class="flex vertical center">
                <p>Coloque uma foto de perfil: </p>
                <img src="" alt="" id="uploadPreview" class="foto"><br>
            </div>
            <input type="file" id="uploadImage" accept="image/*" name="foto" onchange="PreviewImage();"/>
            <script type="text/javascript">
                function PreviewImage(){
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                    oFReader.onload = function(oFREvent){
                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                    }
                }
            </script>
            <input type="submit" class="button" value= "CADASTRAR">
            </form>
            </div>
            </div>
</body>
</html>