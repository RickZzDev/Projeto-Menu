<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();
    
    $sql = " select * from tbl_restaurantes where id_restaurante =  ".$_SESSION['id_restaurante']." ";
    
    $rodaScript = mysqli_query($conexao,$sql);

    $arrayReserva = mysqli_fetch_array($rodaScript);

         /******************PEGANDO DATA PARA CONEFERIR SE O RESTAURANTE ESTA ABERTO */
         $horaAtual =  date('G')-1;
         $dataAtual = date('w');
         /**CONFERINDO SE É FIM DE SEMANA E SE O RSTAURANTE ABRE NESSES DIAS*/
         if(date('w')==6){
             //Verificando se abre de sabado
             if($arrayReserva['abre_sab']==1){
                 if($horaAtual >= $arrayReserva['hora_abre_sab']   && $horaAtual< $arrayReserva['hora_fecha_sab']){
                     $statusRes = 'ABERTO';
                 }else{
                     $statusRes = 'FECHADO';
                 }
             }else{
                 $statusRes = 'FECHADO';
             }
         }//Confeerindo se é domingo e se o restaurante abre nesses dias
         if(date('w')==0){
             if($arrayReserva['abre_dom']==1){
                 if($horaAtual >= $arrayReserva['hora_abre_dom']   && $horaAtual< $arrayReserva['hora_fecha_dom']){
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
             if($dataAtual >= $arrayReserva['dia_sem_inicial']   && $dataAtual<= $arrayReserva['dia_sem_final'] ){
                 if($horaAtual>= $arrayReserva['hora_abre_sem'] && $horaAtual <= $arrayReserva['hora_fecha_sem']){
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
    <title>Reserva</title>
    <link rel="stylesheet" href="css/reserva1.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.form.js"></script>
    <script>



        //Ao clicar no botao de continuar, envio o dia e a hora selecionado para o PHP criar um array
        //E posteriormente inseri-lo no banco de dados
        function criarArray(hora)
        {
            var dia = document.getElementById('slct').value
            $.ajax({
            type:'POST',
            url:'funcoes/confereDia.php',
            data:{
                horaEscolhido: hora,
                diaEscolhido: dia
              
            },
            error: function() {
            alert('Erro ao tentar ação!');
            },
            //É necessário conerter novamente o json para que não venha como string
            success: function(data) {
                var json = JSON.parse(data);
                console.log(json)
                window.location = 'reserva2.php';
            },

        })
        }


        //Conferindo se o dia que foi escolhido é um dia de semana
        //O ajax envia para a função os dados retornados do select
        function mostraHorarios(numDia){
        $.ajax({
            type:'POST',
            url:'funcoes/confereDia.php',
            data:{
                numDia: numDia.value,

            },
            error: function() {
            alert('Erro ao tentar ação!');
            },
            //É necessário conerter novamente o json para que não venha como string
            success: function(data) {
                var json = JSON.parse(data);
                criaDivs(json)
             
            },

        })
        }

        //Esta função ira criar as divs com os horarios disponiveis
        function criaDivs(json){
            document.getElementById('opcoesHorarios').innerHTML += ""
            var horaAbre = parseInt(json[0]);
            var horaFecha = parseInt(json[1]);
            var horasFicaAberto = horaFecha - horaAbre;
            console.log ('hora abre:' + horaAbre + 'hora fecha:' + horaFecha);
            //Lofica para colocar os horarios de meia em meia hora
            for($cont = horaAbre; $cont <= horaFecha ;$cont++ ){
                if($cont % 2 == 0){
                    document.getElementById('opcoesHorarios')
                    .innerHTML +=
                     `<div class='horario' id='${$cont}' onclick='mudaCorDiv(${$cont},${horaAbre},${horaFecha})'>${$cont}:30 </div>`
                }else{
                    document.getElementById('opcoesHorarios').innerHTML += `<div class='horario' id='${$cont}'  onclick='mudaCorDiv(${$cont},${horaAbre},${horaFecha})'>${$cont} </div>`
                }
                
            }
        }

        //Função que muda a cor da div quando ela é clicada
        function mudaCorDiv(id,horaAbre,horaFecha)
        {
           
            document.getElementById(id).style.backgroundColor = "#45fc03";
            apagaDivs(id,horaAbre,horaFecha);
            
        }

        //Função que garante que só uma div receba a colração ao click
       function apagaDivs(id,horaAbre,horaFecha)
       {
           $cont = horaAbre;
           console.log('horaAbre=' + horaAbre + ' horaFecha=' + horaFecha)
            for($teste = horaAbre; $teste <=horaFecha;$teste++)
            {   
                console.log($teste)
                if($teste==id){
                    console.log($teste + '=' + id)
                }else{
                    document.getElementById($teste).style.backgroundColor = "#fff";
                }
                
            }
            //Variavel global para guardar o value da div clicada
            variavel = id;
       }



    </script>
</head>


<body>
    <div id="caixaBgRestaruante">
        <div id="iconeSeta">
            <!-- <img src="images/imgMenuRestaurante/seta.svg"> -->
        </div>

    </div>
    <div id="areaOpcoes">
        <div id="nome_status">
            <div id="divNome">
                <?=$arrayReserva['nome']?>
            </div>
            <div id="divStatus">
                <?=$statusRes?>
            </div>
        </div>
        <div id="opcoes">
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/clock.png"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/userCinza.png"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/checkCinza.png"></div>
                <div class="barraVermelha"></div>
            </div>
        </div>
    </div>
    <form method="post" action="reserva1.php">
        <div id="boxFotoMenu">
            <div id="dia">
                Qual dia desta semana?
                <select name="slct" id="slct" onchange="mostraHorarios(this)">
                    <option selected disabled>Qual o dia?</option>
                    <!-- Esta parte do codigo ira conferir quais os dias em que o restaurante esta aberto e ira joga-los no select -->
                    <?php
                        $diaNum = $arrayReserva['dia_sem_inicial'];
                        $diaNumFinal = $arrayReserva['dia_sem_final'];
                        for($cont = $diaNum; $cont <=$diaNumFinal;$cont++)
                        {

                            switch($cont){
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


                        ?>
                            <option value="<?=$diaNum?>"><?=$diaInicial?></option>

                    <?php
                    }
                    switch($arrayReserva['abre_sab']){
                        case 1:
                            $sab = 'sabado';
                        ?><option value=6><?=$sab?></option>
                    <?php
                        break;
                        case 0:
                            $sab = '';
                        break;   
                    } 
                    switch($arrayReserva['abre_dom']){
                        case 1:
                            $dom = 'domingo';
                        ?><option value=0><?=$dom?></option>
                    <?php
                        break;
                        case 0:
                            $sab = '';
                        break;   
                    }
                    
                    ?>
                </select>
                <!-- <input type="text" id="txtDia" placeholder="Digite o dia da reserva e o mês desejado"> -->
            </div>
            <div id="boxHorarios">
                <div id="tituloHorarios">Qual o horário?</div>
                <div id="opcoesHorarios">
                    
                </div>
            </div>
        </div>
        <!-- <div id="reservarMesa" onclick="window.location = `reserva2.php?hora=${variavel}`">Continuar ></div> -->
        <div id="reservarMesa" onclick="criarArray(`${variavel}`)">Continuar ></div>
    </form>
</body>

</html>