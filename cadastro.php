<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao =  conexaoMySql();

    
    if(isset($_POST['btnContinuar'])){

       $nome = $_POST['txtNome'];
       $senha = $_POST['txtSenha'];
       $celular = $_POST['txtCelular'];
       $email = $_POST['txtEmail'];

       $confereUsuario = "select * from tbl_usuario where email = '".$email."'";

       $rodaConfere = mysqli_query($conexao,$confereUsuario);
    
       if(mysqli_num_rows($rodaConfere)>=1){
            echo("<script>alert('Email já cadastrado')</script>");
       }else{
        $sql = "insert into tbl_usuario (nome,senha,celular,email) values ('".$nome."', '".$senha."', '".$celular."',
        '".$email."')";
    
        if($rodaScript = mysqli_query($conexao,$sql)){
    
    
            $sqlMax = "select max(id_usuario) from tbl_usuario";
            echo $sqlMax;
            $rodaScriptMax = mysqli_query($conexao,$sqlMax);
    
            $array = mysqli_fetch_array($rodaScriptMax);
    
    
            $_SESSION['id_usuario'] = $array['max(id_usuario)'];
        
            header('location: escolhaLogin.php');
        }
       }
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleIntro1.css">

</head>

<body>
    <div id="bgIntro3" class="d-flex p-2 bd-highlight">
        <div id="caixaPrincipalCadastro" class="d-flex p-2 bd-highlight">
            <div id="boxCriarConta">
                <div id="div_seta">

                </div>
                <div id="tituloTxtConta">
                    <img src="images/imgsCadastro/txt.svg">
                </div>
            </div>
           
            <div id="fotoCirculo">
            <label for="fleFotoUsuario" id="labelFoto">
                <div id="boxCamera">
                    <img src="images/imgsCadastro/camera.svg">
                </div>
            </label>
                <!-- <img src="images/imgsCadastro/camera.svg"> -->
            </div>
           
            <input type="file" id="fleFotoUsuario" name="fleFotoUsuario">
            <form name="frmCadastro" method="POST" action="cadastro.php">
                <div class="boxInputs">
                    <div class="boxIconsCadastro">
                        <img src="images/imgsCadastro/nomeIcon.svg">
                    </div>
                    <div class="boxInputsCadastro">
                        <input class="inputsCadastro" type="text" required id="txtNome" name="txtNome" placeholder="NOME">
                    </div>
                </div>
                <div class="boxInputs">
                    <div class="boxIconsCadastro">
                        <img src="images/imgsCadastro/emailIncon.svg">
                    </div>
                    <div class="boxInputsCadastro">
                        <input class="inputsCadastro" type="email" required id="txtEmail" name="txtEmail" placeholder="EMAIL">
                    </div>
                </div>
                <div class="boxInputs">
                    <div class="boxIconsCadastro">
                        <img src="images/imgsCadastro/passworIcon.svg">
                    </div>
                    <div class="boxInputsCadastro">
                        <input class="inputsCadastro" required type="password" id="txtSenha" name="txtSenha" placeholder="SENHA">
                    </div>
                </div>
                <div class="boxInputs">
                    <div class="boxIconsCadastro">
                        <img src="images/imgsCadastro/mobileIcon.svg">
                    </div>
                    <div class="boxInputsCadastro">
                        <input class="inputsCadastro" type="text" id="txtCelular" onkeypress="return mascaraNumero(this,event);" name="txtCelular" placeholder="CELULAR COM DDD">
                    </div>
                </div>
                <label for="btnInput" id="labelInput">
                    <div id="btnContinuar" >
                        CONTINUAR
                    </div>
                </label>
                    <input type="submit" name="btnContinuar" id="btnInput" >
         
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>