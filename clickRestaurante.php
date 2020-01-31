<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

   

    if(isset($_GET['id'])){
        $_SESSION['id_restaurante'] =$_GET['id'];
    }

   
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

            //Esta variavel deixa o coração branco
            $imagemCSS = 'url("images/imgMenuRestaurante/0.png")';
            //Verificando se o restaurante ja foi favoritado pelo usario
            $confereFav = "select id_restaurante from tbl_restaurantes_favoritos where id_usuario =".$_SESSION['id_usuario'];
            
            $rodaConfere = mysqli_query($conexao,$confereFav);

            $arrayIdsFavs = array();
            //Criando um array com os ids dos restaurantes que foram favoritados pelo usuario
            while($arrayIdsRetornados = mysqli_fetch_array($rodaConfere)){
                array_push($arrayIdsFavs, $arrayIdsRetornados['id_restaurante']);
            };
            //Caso o restaurante esteja favoritado, o coração ira ficar vermelho
            if(in_array($_SESSION['id_restaurante'],$arrayIdsFavs)){
               $imagemCSS = 'url("images/imgMenuRestaurante/1.png")';
            }

          


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/clickResMenu.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.form.js"></script>         
    <style>
        /* EFEITO DE TRANSIÇÃO NO FAVORITAR */

                @-webkit-keyframes pulse-grow {
        to {
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
        }

        @keyframes pulse-grow {
        to {
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
        }

        .pulse-grow {
        display: inline-block;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        }
        .pulse-grow:hover, .pulse-grow:focus, .pulse-grow:active {
        -webkit-animation-name: pulse-grow;
        animation-name: pulse-grow;
        -webkit-animation-duration: 0.3s;
        animation-duration: 0.3s;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-direction: alternate;
        animation-direction: alternate;
        }

        /*FIM DO EFEITO  */
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

     
        #iconeFavorito{
            background-image:<?=$imagemCSS?>;
            background-position:center;
            background-repeat: no-repeat;
            position: relative;
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
    <script>
        function favoritar(id){
        
           var el = document.querySelector('#iconeFavorito');
           el.style.backgroundImage = 'url("images/imgMenuRestaurante/1.png")';
           el.style.transition = '0.5s';
           
           $.ajax({
            type:'POST',
                    url: 'funcoes/favoritarRes.php',
                    data: {
                        id: id
                    },
                    error: function(){
                        alert('erro ao trazer os eventos')
                    },
                    success: function(data){
                        
                        console.log(data)
                    }
             
           })
   
        }
    </script>
</head>

<body>
    <div id="caixaBgRestaruante">
        <div id="iconeSeta" class="seta_esquerda">
            <img id="imgSeta" src="images/imgMenuRestaurante/seta.png">
        </div>
        <div id="iconeFavorito" class="pulse-grow" onclick="favoritar('<?=$_SESSION['id_restaurante']?>')" class="icone_favorito">
    
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
            <?=$arraySelect['endereco']?> DISTANCIA EM KM
        </div>
        <div id="opcoes">
            <div class="divOpcao" onclick="window.location = 'clickRestaurante.php'">
                MENU
                <div class="barraVermelha"></div>
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteLocalizacao.php'">
                LOCALIZAÇÂO
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
            <div class="divOpcao" onclick="window.location = 'restauranteSobre.php'">
                SOBRE
                <!-- <div class="barraVermelha bgNone"></div> -->
            </div>
        </div>
    </div>
    <div id="boxFotoMenu">

    </div>
    <div id="reservarMesa" onclick="window.location = 'reserva1.php'">Reservar mesa</div>
</body>

</html>