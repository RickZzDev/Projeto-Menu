<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    $sql = "select tbl_restaurantes.*,tbl_reservas.* from tbl_reservas inner join tbl_restaurantes on tbl_reservas.id_restaurante = tbl_restaurantes.id_restaurante where tbl_reservas.id_usuario =".$_SESSION['id_usuario']." ";

    $rodaScript = mysqli_query($conexao,$sql);

 



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/reservas.css">



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
    <div id="areaReservas">
        <div id="tituloReservas">Minhas reservas
            <div id="barraColorida"></div>
        </div>

        <?php
            while( $select = mysqli_fetch_array($rodaScript))
            {
                /*******PEGANDO A DATA DE ACORDO COM O NUMERO DO DIA NA SEMANA **********************/
                switch($select['dia']){
                    case 0:
                        $diaInicial = 'Domingo';
                    break;    
                    case 1:
                        $diaNum = 1;
                        $diaInicial = 'Seg';
                    break;
                    case 2:
                        $diaNum = 2;
                        $diaInicial = 'Ter';
                    break;
                    case 3:
                        $diaNum = 3;
                        $diaInicial = 'Qua';
                    break;
                    case 4:
                        $diaNum = 4;
                        $diaInicial = 'Qui';
                    break;
                    case 5:
                        $diaNum = 5;
                        $diaInicial = 'Sex';
                    break;
                    
                }

                if($diaInicial == date('w')){
                  $diaInicial = $diaInicial.' Hoje';
                }
               

        ?>
        <!-- Div para entrar no loop -->
        <div class="boxReservas">
            <div class="imgReserva"></div>
            <div class="reservaDados">
                <div class="divLinha">
                    <div class="divNome"><?=$select['nome']?></div>
                    <div class="divStatus">Status</div>
                </div>
                <div class="divLinha">
                    <div class="iconeHora">
                        <img src="../images/imgsMenu/clock.png">
                    </div>
                    <div class="areaTxtDados"><?=$diaInicial?></div>
                </div>
                <div class="divLinha">
                    <div class="iconeTelefone">
                        <img src="../images/imgsMenu/phone.png">
                    </div>
                    <div class="areaTxtDados"><?=$select['tel_res']?></div>
                </div>
                <div class="divLinha">
                    <div class="iconeEmail">
                        <img src="../images/imgsMenu/envelope.png">
                    </div>
                    <div class="areaTxtDados"><?=$select['email_restaurante']?></div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
        <!-- *-**************** -->
    </div>
</body>

</html>