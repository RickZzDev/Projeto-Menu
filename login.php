<?php

    session_start();require_once('bd/conexao.php');$conexao = conexaoMySql();

    if(isset($_POST['btnLogar'])){
        $email = $_POST['txtEmail'];
        $senha = $_POST['txtSenha'];

        $sql = "select * from tbl_usuario where email ='".$email."' and senha = '".$senha."' ";
        
        $rodaScript = mysqli_query($conexao,$sql);

        if($arrayLogin = mysqli_fetch_array($rodaScript)){

            $_SESSION['id_usuario'] = $arrayLogin['id_usuario'];
           header('location:escolhaLogin.php');
        }else{
            $sqlEmail = "select * from tbl_usuario where email ='".$email."' ";
            $rodaScript = mysqli_query($conexao,$sqlEmail);
            if( $arrayEmail = mysqli_fetch_array($rodaScript)){
                echo '<script>alert("Senha incorreta")</script>';
            }else{
                header('location: cadastro.php');
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
        <div id="caixaPrincipalLogin" class="d-flex p-2 bd-highlight">
            <div id="imgIcone" class="d-flex p-2 bd-highlight">
                <img src="images/iconeTitulo.svg">
            </div>
            <div id="txtComece" class="d-flex p-2 bd-highlight">

            </div>
            <form method="POST" action="login.php" name="frmLogin">
                <div id="boxEmail">
                    <div id="imgEmail">
                        <img src="images/imgsLogin/email.svg">
                    </div>
                    <div id="txtEmail">
                        <input type="email" name="txtEmail" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div id="boxEmail">
                    <div id="imgEmail">
                        <img src="images/imgsCadastro/passworIcon.svg">
                    </div>
                    <div id="txtEmail">
                        <input type="password" name="txtSenha" id="inputEmail" placeholder="Senha">
                    </div>
                </div>
                <label for="btnLogar" id="labelInput">
                    <div id="btnContinuar">
                        CONTINUAR
                    </div>
                </label>

                <input type="submit" name="btnLogar" id="btnLogar">

                <div id="divisor">
                    <img src="images/imgsLogin/ou.png">
                </div>
                <div id="boxFacebook">
                    <div id="imgFace">
                    </div>
                    <div id="txtFace">Entrar com Facebook</div>
                </div>
                <div id="boxGoogle">
                    <div id="imgGoogle">

                    </div>
                    <div id="txtGoogle">Entrar com Google</div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>