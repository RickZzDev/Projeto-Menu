<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

    $sql = "select * from tbl_restaurantes where id_restaurante = ".$_SESSION['id_restaurante']." ";

    $rodaScript = mysqli_query($conexao,$sql);

    $arraySobre = mysqli_fetch_array($rodaScript);

    /******************PEGANDO DATA PARA CONEFERIR SE O RESTAURANTE ESTA ABERTO */
    $horaAtual =  date('G')-1;
    $dataAtual = date('w');
    /**CONFERINDO SE É FIM DE SEMANA E SE O RSTAURANTE ABRE NESSES DIAS*/
    if(date('w')==6){
        //Verificando se abre de sabado
        if($arraySobre['abre_sab']==1){
            if($horaAtual >= $arraySobre['hora_abre_sab']   && $horaAtual< $arraySobre['hora_fecha_sab']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
    }//Confeerindo se é domingo e se o restaurante abre nesses dias
    if(date('w')==0){
        if($arraySobre['abre_dom']==1){
            if($horaAtual >= $arraySobre['hora_abre_dom']   && $horaAtual< $arraySobre['hora_fecha_dom']){
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
        if($dataAtual >= $arraySobre['dia_sem_inicial']   && $dataAtual<= $arraySobre['dia_sem_final'] ){
            if($horaAtual>= $arraySobre['hora_abre_sem'] && $horaAtual <= $arraySobre['hora_fecha_sem']){
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
    <title>Sobre</title>
    <link rel="stylesheet" href="css/clickResMenu.css">
    <link rel="stylesheet" href="css/sobreRestaurante.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>

        img{
            max-width: 100%;
            height: auto;
        }

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

       .div_pag_img{
           width: 15%;
           height: 82%;
           
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
               <?=$arraySobre['nome']?>
            </div>
            <div id="divStatus">
                <?=$statusRes?>
            </div>
        </div>
        <div id="boxLocalizacao">
        <?=$arraySobre['endereco']?> + DISTANCIA EM KM
        </div>
        <div id="opcoes">
            <div class="divOpcao" onclick="window.location = 'clickRestaurante.php'">
                MENU
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteLocalizacao.php'">
                LOCALIZAÇÂO
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteSobre.php'">
                SOBRE
                <div class="barraVermelha "></div>
            </div>
        </div>
    </div>
    <div id="areaSobre">
        <div id="nota_avaliar">
            <div id="nota">estrelas avalização</div>
            <div id="avaliar">+Avaliar</div>
        </div>
        <div id="txtSobre">
            <?=$arraySobre['descricao']?>
        </div>
        <div id="areaBoxes">
            <div class="boxes">
                <div class="tituloBoxes">Mais Informações</div>
                <div class="infoBd">
                    <?php
                    
                    switch($arraySobre['dia_sem_inicial']){
                        case 1:
                            $diaInicial = 'Seg';
                        break;
                        case 2:
                            $diaInicial = 'Ter';
                        break;
                        case 3:
                            $diaInicial = 'Qua';
                        break;
                        case 4:
                            $diaInicial = 'Qui';
                        break;
                        case 5:
                            $diaInicial = 'Sex';
                        break;
                        
                    }
                    switch($arraySobre['dia_sem_final']){
                        case 1:
                            $diaFinal = 'Seg';
                        break;
                        case 2:
                            $diaFinal = 'Ter';
                        break;
                        case 3:
                            $diaFinal = 'Qua';
                        break;
                        case 4:
                            $diaFinal = 'Qui';
                        break;
                        case 5:
                            $diaFinal = 'Sex';
                        break;
                    } 

                    if($arraySobre['abre_sab']==0){
                        $horaAbreSab = 'fechado';
                        $horaFechaSab ='';
                    }else{
                        $horaAbreSab = $arraySobre['hora_abre_sab'].'h - ';
                        $horaFechaSab = $arraySobre['hora_fecha_sab'].'h';
                    }
                    
                    echo($diaInicial.'-'.$diaFinal.': '.$arraySobre['hora_abre_sem']."h".' - '.$arraySobre['hora_fecha_sem'].'h'.'<br>'.
                    'sábado -'.$horaAbreSab.$horaFechaSab);

                    ?>
                    <br>
                    <?=$arraySobre['bairro']?><br>
                    <?=$arraySobre['cidade']?><br>
                    <?=$arraySobre['uf']?><br>
                </div>
             
            </div>
            <div class="boxes alinhaDireita ">
                <div class="tituloBoxes">Formas de pagamento</div>
                <div id="pagDebito">
                    <hr width="10%">Debito e credito
                    <hr width="20%">Debito
                    <hr width="18%">
                </div>
                <div class="imgsPag ">
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/mastercard.png">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/visa.png">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/elo.jpg">
                    </div>
                </div>
                <div id="pagCredito">
                    <hr width="40%">Credito
                    <hr width="45%">

                </div>
                <div class="imgsPag">
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/amex.jpg">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/hipercard.jpg">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/hiper.jpg">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/dinners.jpg">
                    </div>
                    <div class="div_pag_img">
                        <img src="images/imgMenurestaurante/cabal.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>