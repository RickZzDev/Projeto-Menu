<?php

    session_start();

    $_SESSION['tipoCadastro'] = 'evento';

    if(isset($_POST['btnContinuar'])){
        $_SESSION['arrayCadastro'] = array(
            '0',
            $_POST['nomeEvento'],
            $_POST['dataEvento'],
            $_POST['horaEvento'],
            $_POST['descEvento']
        );

        // var_dump($_SESSION['arrayCadastroEvento']);

        header('location:cadastro2.php ');
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
    <link rel="stylesheet" type="text/css" href="css/cadastroEvento1.css">



</head>

<body>
    <div id="boxVermelho">
        <div id="menu_logo">

            <div id="boxMenu">

                <img src="../images/imgsTelaPrincipal/menu.svg">
                <div id="div_menu">
                    <div class="menu_itens">
                        RESTAURANTES/EVENTOS
                    </div>
                    <div class="menu_itens">
                        RESERVAS
                    </div>
                </div>

            </div>
            <div id="boxLogo">
                <div id="centro_logo">
                    <img id="LogoPrincipal" src="../images/imgsTelaPrincipal/logo.png">
                </div>
            </div>
        </div>

    </div>
    <div id="areaCadastro">
        <div id="boxSteps">
            <div class="boxIcon friends" onclick="window.location =  `${teste}`"></div>
            <div class="boxIcon location" onclick="window.location = 'cadastro2.php'"></div>
            <div class="boxIcon user" onclick="window.location = 'cadastro3.php'"></div>
            <div class="boxIcon check" onclick="window.location = 'cadastro4.php'"></div>
        </div>
        <div id="txt1">Selecione o tipo de empresa</div>
        <div id="boxRadios">
            <div id="restaurante_radio">
                <input type="radio" name="rdo" onclick="window.location = 'cadastroRestaurante.php'">
                <div id="txtRestaurante">Restaurantes</div>
            </div>
            <div id="evento_radio">
                <input type="radio" checked onclick="window.location = 'cadastroEvento.php'">
                <div id="txtRestaurante">Eventos e shows</div>
            </div>
        </div>
        <form method="POST" action="cadastroEvento.php" id="frmCadastroEvento">
            <input type="text" name="nomeEvento" class="txtInput" placeholder="Nome do evento">
            <input type="text" name="dataEvento" class="txtInput" id="data" onkeypress="return mascaraData(this,event);" placeholder="Data">
            <input type="text" name="horaEvento" class="txtInput" placeholder="Hora">
            <input type="text" name="descEvento" class="txtInput maior" placeholder="Descrição do evento">
            <label for="fleFotoLogo">
            <div id="div_logo_marca">
                <div id="iconCamera">
                </div>
                <div id="txtLogo">LOGO MARCA</div>
                <input type="file" id="fleFotoLogo">
            </div>
            </label>
            <label for="btnContinuarInput">
                <div id="btnContinuar">
                    CONTINUAR
                    <div id="iconSeta">

                    </div>
                </div>
            </label>

            <input type="submit" id="btnContinuarInput" name="btnContinuar">

        </form>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>