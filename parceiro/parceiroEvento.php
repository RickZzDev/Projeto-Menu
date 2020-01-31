<?php

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    session_start();

   

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
    <link rel="stylesheet" type="text/css" href="css/parceiroEvento.css">



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
            <div id="tituloArea">
                Área Parceiro
            </div>
            <div id="restaurante_evento">
                <div id="div_restaurante"  onclick="window.location = 'parceiroRestaurante.php'">Restaurante</div>
                <div id="div_evento" onclick="window.location = 'parceiroEvento.php'">Evento</div>
            </div>
        </div>

          <!-- ************* -->
        <?php
            $sql = "select * from tbl_eventos where id_usuario = ".$_SESSION['id_usuario']."";
           

            $rodaScript = mysqli_query($conexao,$sql);

            while($arraySelect = mysqli_fetch_array($rodaScript)){

            
        ?>
        <div class="boxEvento">
            <div class="imgEvento"></div>
            <div class="infoEvento">
                <div class="nomeEvento">
                    <?=$arraySelect['nome']?>
                </div>
                <div class="data_hora_evento">
                    <div class="imgClock"></div>
                    <div class="txtHora">
                        <?=$arraySelect['data_evnt']?> às <?=$arraySelect['hora']?>
                    </div>
                </div>
            </div>
            <div class="imgSeta">

            </div>
        </div>
        <?php
            }
        ?>
        <!-- ************* -->
        <div id="div_adicionar" onclick="window.location = 'cadastroEvento.php'">+</div>
    </div>
</body>

</html>