<?php

    session_start();

   
    
    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

    if(isset($_SESSION['clicou'])==true){
        // echo 'deu certo';
    }

    if(isset($_GET['btnMostrarMais'])){
        // echo 'clicou';
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
    <link rel="stylesheet" type="text/css" href="css/stylePgRestaurantes.css">
    <script src="js/jquery.js"></script>
    <style>
        #btnMostrarMais{
            display: none;
        }
    </style>

</head>

<body>
    <div id="boxVermelho">
        <div id="menu_logo">

            <div id="boxMenu">
                <img src="images/imgsTelaPrincipal/menu.svg">
                <div id="div_menu">
                    <div id="nome_foto_local">
                        <div id="fotoUsuario">

                        </div>
                        <div id="dadosUsuarioNome">
                            BARBARA
                        </div>
                        <div id="dadosUsuarioLocal">
                            <img src="images/imgsMenu/icons.svg"> RIO DE JANEIRO
                        </div>

                    </div>
                    <div class="menu_itens" onclick="window.location = 'Restaurantes.php'">
                        RESTAURANTES
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/eventos.php'">
                        EVENTOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/favoritos.php'">
                        FAVORITOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/reservas.php'">
                        MINHAS RESERVAS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/sobreApp.php'">
                        SOBRE
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/contatoApp.php'">
                        CONTATO
                    </div>
                    <div class="menu_itens" onclick="window.location = 'opcoesMenu/sejaParceiro.php'">
                        SEJA PARCEIRO
                    </div>
                </div>
            </div>
            <div id="boxLogo">
                <div id="centro_logo">
                    <img id="LogoPrincipal" src="images/imgsTelaPrincipal/logo.png">
                </div>
            </div>
        </div>
        <div id="buscar">
            <div id="boxInput">
                <div id="imgLupa">
                    <img src="images/imgsTelaPrincipal/lupa.svg">
                </div>
                <input type="text" placeholder="Rua, Local, Restaruante" id="txtBuscar">
            </div>
            <div id="divFiltro">
                <div id="box_img_select">
                    <div id="imgFiltro">
                        <img src="images\imgsTelaPrincipal\filtro.png">
                    </div>
                    <div id="sltFiltro"> Restaurantes mais proximos</div>
                </div>
            </div>
        </div>
    </div>
    <form name="frmRestaurantes" method="GET" action="Restaurantes.php">
        <div id="areaRestaurantes">
            <!-- Div para entrar no loop -->
    
            <!--  -->
            <div id="divRestaurantes">
            <?php
                $sql = 'select * from tbl_restaurantes';

                $rodaScript = mysqli_query($conexao,$sql);

                if(isset($_GET['btnMostrarMais'])){
                    $i = 0;
                    $_SESSION['cont'] += 2;
                }else{
                    $i = 0;
                    $_SESSION['cont'] = 3;
                }
        
                if($i<= $_SESSION['cont']){

                
                for($i;$arraySelect = mysqli_fetch_array($rodaScript);$i++){
                    
                
            ?>
                <div id="boxPrincipalRestaurante" onclick="window.location = 'clickRestaurante.php?id=<?=$arraySelect['id_restaurante']?>'">
                    <div id="imgRestaurante">
                        <img id="restauranteImg" src="images/imgsTelaPrincipal/restaurante.jpg">
                    </div>
                    <div id="nomeRestaurante">
                        <?=$arraySelect['nome']?>
                    </div>
                    <div id="enderecoRestaurante">
                        <?=$arraySelect['endereco']?>
                    </div>
                    <div id="hastagsRestaurante">
                        2km, <?=$arraySelect['tipo_culinaria']?>
                    </div>
                    <div id="avaliacoesRestaurante">
                        Avaliações restaurante
                    </div>
                </div>


                <?php
                
                
                if($i== $_SESSION['cont']){
                    @$_SESSION['clicou']==false; 
                    break;
                    
                    
                }    
            }

            $i++;


            

        }
 
        ?>  
            </div>
            <!--  -->
  
            <!--  -->
            <input id="btnMostrarMais" name="btnMostrarMais" type="submit">
            <label for="btnMostrarMais">
                <div id="verMaisRestaurantes" for="teste">
                    <img id="verMaisRestaurantesPng" alt="ver mais restaurantes" src="images/imgsTelaPrincipal/verMaisRestaurantes.png">
                </div>
            </label>


        </div>
    </form>
</body>

</html>