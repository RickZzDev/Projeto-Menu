<?php
    session_start();


    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Favoritos</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/favoritos.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.form.js"></script>


    

</head>

<body>
    <div id="boxVermelho">
        <div id="menu_logo">

            <div id="boxMenu">
                <img src="../images/imgsTelaPrincipal/menu.svg">
                <div id="div_menu">
                    <div id="nome_foto_local">
                        <div id="fotoUsuario">

                        </div>
                        <div id="dadosUsuarioNome">
                            BARBARA
                        </div>
                        <div id="dadosUsuarioLocal">
                            <img src="../images/imgsMenu/icons.svg"> RIO DE JANEIRO
                        </div>

                    </div>
                    <div class="menu_itens" onclick="window.location = '../Restaurantes.html'">
                        RESTAURANTES
                    </div>
                    <div class="menu_itens" onclick="window.location = 'eventos.html'">
                        EVENTOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'favoritos.html'">
                        FAVORITOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'reservas.html'">
                        MINHAS RESERVAS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'sobreApp.html'">
                        SOBRE
                    </div>
                    <div class="menu_itens" onclick="window.location = 'contatoApp.html'">
                        CONTATO
                    </div>
                    <div class="menu_itens" onclick="window.location = 'sejaParceiro.html'">
                        SEJA PARCEIRO
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
    <div id="areaFavoritos">
        <div id="restaurante_evento">
            <div id="tituloFavoritos">
                Favoritos
            </div>
            <div id="divOpcaoRestaurante_evento">
                <div id="divOpcaoRestaurante" onclick="coloreBarra(1)">
                    RESTAURANTES
                    <div class="barraCinza">
                        <div id="barraColorida"></div>
                    </div>
                </div>
                <div id="divOpcaoEvento" onclick="coloreBarra(2)">
                    EVENTOS
                    <div class="barraCinza">
                        <div id="barraColorida2"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- DIV QUE IRA RECEBER OS DADOS RETORNADOS -->
        <div id="teste">

        </div>



    </div>

    <script src="js/favorito.js"></script>
</body>

</html>