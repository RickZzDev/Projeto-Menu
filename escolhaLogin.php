<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao =  conexaoMySql();

    
    $sql = "select * from tbl_usuario where id_usuario ='".$_SESSION['id_usuario']."' and parceria = 1 ";

    // echo $sql;

    if(mysqli_num_rows( $rodaScript = mysqli_query($conexao,$sql)) > 0){
        $confereAuth = "window.location = 'parceiro/minhasReservas.php'";
    }else{
        $confereAuth = "alert ('Favor logar como usuario e se cadastrar como parceiro')";
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

            <div id="loginParceiro" onclick="<?=$confereAuth?>">
                ENTRAR COMO PARCEIRO
            </div>
            <div id="loginUsuario" onclick="window.location = 'Restaurantes.php'">
                ENTRAR COMO USUARIO
            </div>


        </div>
    </div>
</body>

</html>