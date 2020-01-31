<?php

    session_start();

    require_once('bd/conexao.php');

    var_dump($_SESSION['reservaArray']);

    $conexao = conexaoMySql();
    /*************************RECUPERANDO DADOS DO RESTAURANTE*******************/

    $sqlRestuarante = "select * from tbl_restaurantes where id_restaurante = ".$_SESSION['id_restaurante']." ";

    $rodaScript = mysqli_query($conexao,$sqlRestuarante);

    $arrayRestaurante = mysqli_fetch_array($rodaScript);

    /******************RECUPERANDO DADOS DO USUARIO LOGADO*********************/
    $sqlUsuario = 'select * from tbl_usuario where id_usuario = '.$_SESSION['id_usuario'].' ';

    $rodaScript = mysqli_query($conexao,$sqlUsuario);

    $arrayUsuario = mysqli_fetch_array($rodaScript);
    /*************************************************************************/


    /******************PEGANDO DATA PARA CONEFERIR SE O RESTAURANTE ESTA ABERTO */
    $horaAtual =  date('G')-1;
    $dataAtual = date('w');
    /**CONFERINDO SE É FIM DE SEMANA E SE O RSTAURANTE ABRE NESSES DIAS*/
    if(date('w')==6){
        //Verificando se abre de sabado
        if($arrayRestaurante['abre_sab']==1){
            if($horaAtual >= $arrayRestaurante['hora_abre_sab']   && $horaAtual< $arrayRestaurante['hora_fecha_sab']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
    }//Confeerindo se é domingo e se o restaurante abre nesses dias
    if(date('w')==0){
        if($arrayRestaurante['abre_dom']==1){
            if($horaAtual >= $arrayRestaurante['hora_abre_dom']   && $horaAtual< $arrayRestaurante['hora_fecha_dom']){
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
        if($dataAtual >= $arrayRestaurante['dia_sem_inicial']   && $dataAtual<= $arrayRestaurante['dia_sem_final'] ){
            if($horaAtual>= $arrayRestaurante['hora_abre_sem'] && $horaAtual <= $arrayRestaurante['hora_fecha_sem']){
                $statusRes = 'ABERTO';
            }else{
                $statusRes = 'FECHADO';
            }
        }else{
            $statusRes = 'FECHADO';
        }
        
    }


    /*************************ENVIANDO PAS INFORMAÇÕES PARA A TABELA DE RESERVA**********************************/
        
        /*CONFERINDO SE O HORARIO É REDONDO O :30*/ 
        if($_SESSION['reservaArray']['horaEscolhido']%2 == 0)
        {
            $hora = $_SESSION['reservaArray']['horaEscolhido'].':30';
        
        }
        /*Se não for, sera inserido normalmente no banco*/
        else{
            $hora = $_SESSION['reservaArray']['horaEscolhido'];
        }

        $sqlReserva = 'insert into tbl_reservas (id_usuario,id_restaurante,dia,hora,qntd_pessoas,obs)
        values
         ('.$_SESSION['id_usuario'].','.$_SESSION['id_restaurante'].','.$_SESSION['reservaArray']['diaEscolhido'].',"'.$hora.'",'.$_SESSION['reservaArray'][0].', "'.$_SESSION['reservaArray'][1].'") ';

        echo $sqlReserva;

         $rodaScript = mysqli_query($conexao,$sqlReserva);
         



    /******************************************************/

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/reservaSucess.css">
    
</head>

<body>
    <div id="caixaBgRestaruante">
        <div id="iconeSeta">
            <img src="images/imgMenuRestaurante/seta.svg">
        </div>

    </div>
    <div id="areaOpcoes">
        <div id="nome_status">
            <div id="divNome">
                <?=$arrayRestaurante['nome']?>
            </div>
            <div id="divStatus">
                <?=$statusRes?>
            </div>
        </div>
        <div id="opcoes">
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/clock.svg"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/users.svg"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/check.png"></div>
                <div class="barraVermelha"></div>
            </div>
        </div>
    </div>
    <div id="boxFotoMenu">
        <div id="caixaTxt1">
            Obrigado!
        </div>
        <div id="caixaTxt2">
            Em breve você receberá a confirmação da sua reserva via e-mail ou telefone em até 24h.<br><br> Em caso de duvida entre em contato com o restaurante <?=$arrayRestaurante['tel_res']?>
        </div>
        <div id="boxLigar">
            <div id="areaIcone"></div>Ligar agora</div>
        <div id="boxInicio">
            <div id="areaIconeHome" onclick="window.location = 'Restaurantes.php'"></div>Voltar ao início do app</div>
    </div>
    <div id="reservarMesa">Continuar</div>
</body>

</html>