<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

    $sql = "select * from tbl_restaurantes where id_restaurante = '".$_SESSION['id_restaurante']."' ";

    $rodaScript = mysqli_query($conexao,$sql);

    $arraySelect = mysqli_fetch_array($rodaScript);


    /******************PEGANDO DATA PARA CONEFERIR SE O RESTAURANTE ESTA ABERTO */
    $horaAtual =  date('G')-1;
    $dataAtual = date('w');
    /**CONFERINDO SE É FIM DE SEMANA E SE O RSTAURANTE ABRE NESSES DIAS*/
    if(date('w')==6){
        //Verificando se abre de sabado
        if($arraySelect['abre_sab']==1){
            if($horaAtual >= $arraySelect['hora_abre_sab']   && $horaAtual< $arraySelect['hora_fecha_sab']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
    }//Confeerindo se é domingo e se o restaurante abre nesses dias
    if(date('w')==0){
        if($arraySelect['abre_dom']==1){
            if($horaAtual >= $arraySelect['hora_abre_dom']   && $horaAtual< $arraySelect['hora_fecha_dom']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
    }//Conferindo o dia e a hora semanal para ver se o restaurante esta aberto
    else{
        //Conferindo se a data do dia esta entre os dias em que o restaurante abre
        if($dataAtual >= $arraySelect['dia_sem_inicial']   && $dataAtual<= $arraySelect['dia_sem_final'] ){
            if($horaAtual>= $arraySelect['hora_abre_sem'] && $horaAtual <= $arraySelect['hora_fecha_sem']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
        
    }



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>localização</title>
    <link rel="stylesheet" href="css/clickResMenu.css">
    <link rel="stylesheet" href="css/restauranteLocalizacao.css">

    <style>
        .seta_esquerda{
            background-position: center;
            box-sizing: border-box;
            margin-left: 1vw;
            margin-top: 1vh;
            display: flex;
        } 

        .icone_favorito{
            background-position: center;
            box-sizing: border-box;
            margin-right: 1vw;
            margin-top: 1vh;
            display: flex;
        }

        #imgFavorito{
            margin-left: auto;
            margin-right: auto;
            height: auto;
            max-width:100%;
        }

        #imgSeta{
            margin-left: auto;
            margin-right: auto;
            height: auto;
            max-width:100%;
        }

        .bgNone{
           background-color: white;
       }
    </style>
</head>

<body>
    <div id="caixaBgRestaruante">
        <div id="iconeSeta" class="seta_esquerda">
            <img id="imgSeta" src="images/imgMenuRestaurante/seta.png">
        </div>
        <div id="iconeFavorito" class="icone_favorito">
                <img id="imgFavorito" src="images/imgMenuRestaurante/0.png">
        </div>
    </div>
    <div id="areaOpcoes">
        <div id="nome_status">
            <div id="divNome">
                <?=$arraySelect['nome']?>
            </div>
            <div id="divStatus">
                <?=$statusRes?>
            </div>
        </div>
        <div id="boxLocalizacao">
            <?=$arraySelect['endereco']?> + DISTANCIA EM KM
        </div>
        <div id="opcoes">
            <div class="divOpcao" onclick="window.location = 'clickRestaurante.php'">
                MENU
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteLocalizacao.php'">
                LOCALIZAÇÂO
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteSobre.php'">
                SOBRE
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
        </div>
    </div>
    <div id="areaLocalizacao">
        <div id="titulo">Estamos esperando você!</div>
        <div id="tracarRota">
            traçar rota
        </div>
        <div id="areaMapa">
            Mapa
        </div>
    </div>

</body>

</html>