<?php
    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();



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
    <link rel="stylesheet" type="text/css" href="css/parceiroRestaurante.css">
    <link rel="stylesheet" type="text/css" href="css/parceiroEvento.css">

    <script>
    
        function mudaDiv(){

            var box = document.querySelector('.boxRestaurantes');
         
            box.style.display = 'none';
        }
    </script>

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
        <div id="areaCadastro">
            <div id="boxSteps">
                <div id="tituloArea">
                    Área Parceiro
                </div>
                <div id="restaurante_evento">
                    <div id="div_restaurante">Restaurante</div>
                    <div id="div_evento" onclick="window.location = 'parceiroEvento.php'">Evento</div>
                </div>
            </div>
            <?php
                $selectRestaurantes = "select * from tbl_restaurantes where id_parceiro = '".$_SESSION['id_usuario']."'  ";
                $rodaSelect = mysqli_query($conexao,$selectRestaurantes);
                while($arraySelect = mysqli_fetch_array($rodaSelect)){

                $cont = count($arraySelect['nome'])
            ?>
                <div class="boxRestaurantes" >
                    <div class="imgRestaurante"></div>
                    <div class="infoRestaurante">
                        <div class="nomeRestaurante">
                            <?=$arraySelect['nome']?>
                        </div>
                        <div class="enderecoRestaurante">
                            <?=$arraySelect['endereco']?>
                        </div>
                    </div>
                    <div class="imgSeta">

                    </div>
                </div>
            <?php
                }
            ?>


            <div id="div_acrescentar" onclick="window.location = 'cadastroRestaurante.php'">
                +
            </div>
        </div>
        <script src="../js/script.js"></script>
</body>

</html>