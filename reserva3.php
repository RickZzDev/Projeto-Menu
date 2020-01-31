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

     

?>
<!DOCTYPE html> 
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserva 3</title>
    <link rel="stylesheet" href="css/reserva3.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.form.js"></script>
    <script>
       function completaReserva(obs){
        $.ajax({
            type:'POST',
            url:'funcoes/confereDia.php',
            data:{
                obs: obs,

            },
            error: function() {
            alert('Erro ao tentar ação!');
            },
            //É necessário conerter novamente o json para que não venha como string
            success: function() {
                window.location = 'reservaSucess.php';
            },

        })
        }
    </script>
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
        <div id="confirmeTitulo">
            Confirme sua reserva
        </div>
        <form method="post" action="reserva3.php" name="frmConfirm">
            <div class="group">
                <input type="text" class="inputRadius" value="<?=$arrayUsuario['nome']?>" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Name</label>
            </div>
            <!-- <div class="group">
                <input type="text" class="inputRadius" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Sobrenome</label>
            </div> -->
            <div id="divTelefone">
                <div id="divDDD">
                    <div class="group">
                        <input type="text" class="inputRadius" value="+55" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>DDI</label>
                    </div>
                </div>
                <div id="numeroTelefone">
                    <div class="group">
                        <input type="text" class="inputRadius" value="<?=$arrayUsuario['celular']?>" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>DDD+Telefone</label>
                    </div>
                </div>
            </div>
            <div class="group">
                <input type="text" class="inputRadius" value="<?=$arrayUsuario['email']?>" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>email</label>
            </div>
            <div class="group">
                <input type="text" id='txtObs' class="inputRadius teste" required>
                <span class="highlight"></span>
                <span class="barObs bar"></span>
                <label>Observações</label>
            </div>
        </form>
    </div>
    <div id="reservarMesa" onclick='completaReserva(document.getElementById("txtObs").value)'>Continuar</div>
</body>

</html>