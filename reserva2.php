<?php
    session_start();

    var_dump($_SESSION['reservaArray']);

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
    <title>Document</title>
    <link rel="stylesheet" href="css/reserva2.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.form.js"></script>

    <script>


function qntdPessoas(){

        
        $.ajax({
            type:'POST',
            url:'funcoes/confereDia.php',
            data:{
                numPessoas: idGlobal,

            },
            error: function() {
            alert('Erro ao tentar ação!');
            },
            //É necessário conerter novamente o json para que não venha como string
            success: function(data) {
                var json = JSON.parse(data);
                window.location = 'reserva3.php';
             
            },

        })
        }
        //Função que colore a div clicada
        function mudaCorDiv(id)
        {
            idGlobal = id;
            document.getElementById(id).style.backgroundColor = "#45fc03";
            apagaDivs(id);
            
        }

        //Função que garante que as outras divs se mantenham brancas
       function apagaDivs(id)
       {

            for($cont = 1; $cont<=8;$cont++)
            {   
             
                if($cont==id){
                  
                }else{
                    document.getElementById($cont).style.backgroundColor = "#fff";
                }
                
            }

            variavel = id;
       }
    </script>
</head>

<body>
    <div id="caixaBgRestaruante">
        <div id="iconeSeta">
            <img src="images/imgMenuRestaurante/seta.svg">
        </div>
        <div id="iconeFavorito"></div>
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
                <div class="reservaProg"><img src="images/imgsReserva/clockCinza.png"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/usersChecked.png"></div>
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao">
                <div class="reservaProg"><img src="images/imgsReserva/checkCinza.png"></div>
                <div class="barraVermelha"></div>
            </div>
        </div>
    </div>
    <div id="boxFotoMenu">
        <div id="tituloNumeroPessoas">
            Numero de pessoas
        </div>
        <div id="boxNumeroPessoas">
            <div class="areaBoxes">
                <?php
                    for($cont = 1;$cont<=4;$cont++)
                    {
                ?>
                    <div class="numeroPessoas" id="<?=$cont?>" onclick="mudaCorDiv(<?=$cont?>)"><?=$cont?></div>
                <?php
                    }
                ?>
      
            </div>
            <div class="areaBoxes">
            <?php
                    for($cont = 5;$cont<=8;$cont++)
                    {
                ?>
                    <div class="numeroPessoas" id="<?=$cont?>" onclick="mudaCorDiv(<?=$cont?>)"><?=$cont?></div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="reservarMesa" onclick='qntdPessoas()'>Continuar</div>
</body>

</html>