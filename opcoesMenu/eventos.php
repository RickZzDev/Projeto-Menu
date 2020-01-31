<?php

    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    $sql = 'select * from tbl_eventos';

    //Pegando os eventos que estão favoritados pelo usuário
    $sqlFavoritos = 'select id_evento from tbl_favoritos where id_usuario ='.$_SESSION['id_usuario'];

    $scriptFavoritos = mysqli_query($conexao,$sqlFavoritos);

    $eventosFavoritos = array();
    
    while($arrayFavoritos =  mysqli_fetch_array($scriptFavoritos)){
        $id_favorito = intval( $arrayFavoritos['id_evento']);
        array_push($eventosFavoritos , $id_favorito);
    
    }

    


    


   
 
   
    // echo $sqlFavoritos;

    //************************************************************************** */
    $rodaScript = mysqli_query($conexao,$sql);

   

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
    <link rel="stylesheet" type="text/css" href="css/eventos.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script>

        // $(document).ready(function(){
        //         $.ajax({
        //             type:'POST',
        //             url: '../funcoes/buscaEventos.php',
        //             error: function(){
        //                 alert('erro ao trazer os eventos')
        //             },
        //             success: function(data){
                        
        //                 console.log(data)
        //             }
        //         })
        //     })

        //Esta função ira recuperar o numero de eventos que aparecem na tela    
        function resgataNumEventos(cont){
            eventoNum = cont -1
        }

        //script para mudar a cor do coração quando ele é clicado
        function favoritar(id,idFav,idDb){
            
            //Recebendo o id da div e do icone para preencher a cor do coração e para sumir com a div
            document.getElementById(idFav).style.backgroundImage = 'url("../images/imgsMenu/1.png")';
            document.getElementById(idFav).style.transition = '0.5s';
            //Diminuindo a div e fazendo ela sumir lentamente
            document.getElementById(id).style.opacity = '0';
            document.getElementById(id).style.height = '0px';
            document.getElementById(id).style.transition = '1s';
            //deixando a div de baixo ficar por cima, para que ela seja clicavel
            //Estou conferindo se o evento clicado foi o ultimo, caso tenha sido, não sera aplicado as
            //Propriedades css pois não há nada a baixo deste elemento
            if(id == eventoNum){
            //    Pula e nao adiciona as propriedades css
            }else{
   
                
                document.getElementById(id).style.zIndex = '0';
                document.getElementById(id+1).style.zIndex = '999';
            }
           
            
            enviaEventoBd(idDb);

        }

        function enviaEventoBd(idDb){
          
            $.ajax({
                    type:'POST',
                    url: '../funcoes/buscaEventos.php',
                    data: {
                        idDb: idDb
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
                    <div class="menu_itens" onclick="window.location = '../Restaurantes.php'">
                        RESTAURANTES
                    </div>
                    <div class="menu_itens" onclick="window.location = 'eventos.php'">
                        EVENTOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'favoritos.php'">
                        FAVORITOS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'reservas.php'">
                        MINHAS RESERVAS
                    </div>
                    <div class="menu_itens" onclick="window.location = 'sobreApp.php'">
                        SOBRE
                    </div>
                    <div class="menu_itens" onclick="window.location = 'contatoApp.php'">
                        CONTATO
                    </div>
                    <div class="menu_itens" onclick="window.location = 'sejaParceiro.php'">
                        SEJA PARCEIRO
                    </div>
                </div>
            </div>
            <div id="boxLogo">
                <div id="centro_logo">
                    <img id="LogoPrincipal" src="../images/imgsTelaPrincipal/logo.png">
                </div>
                <div id="buscar">
                    <div id="boxInput">
                        <div id="imgLupa">
                            <img src="../images/imgsTelaPrincipal/lupa.svg">
                        </div>
                        <input type="text" placeholder="Rua, Local, Restaruante" id="txtBuscar">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="areaEvento">

      
        <?php 
            $cont = 0;
            while($selectEventos = mysqli_fetch_array($rodaScript))
            {
                // Conferindo se o id que retorna esta entre o array dos ids favoritados pelo usuario
                // se estiver, não ira aparecer na tela
                $tamanhoArray = count($eventosFavoritos);
                $id_evento = intval($selectEventos['id_evento']);
              
        
         

           
            
                /*********Esta query ira conferir se o evento retornado está ou nao favoritado pelo usuario*************** */

                // $sqlConfereFav = 'select tbl_eventos.*, tbl_favoritos.* from tbl_eventos inner join tbl_favoritos on tbl_eventos.id_evento = tbl_favoritos.id_evento where tbl_favoritos.id_usuario ='.$_SESSION['id_usuario'];
                
                // $rodaConfere = mysqli_query($conexao,$sqlConfereFav);

                // $arrayConfere = mysqli_fetch_array($rodaConfere);


                
                // if($selectEventos['id_evento'])
                /*******************************************************************************************************/
              
                //Separando os dados da data
                $dataArray = explode("/",$selectEventos['data_evnt']);
                $dia = $dataArray[0];
                $mes= $dataArray[1];
                //Transformando o numero do mes em seu respectivo nome
                switch($mes){
                    case '1':
                        $mes = 'JAN';
                    break;
                    case '2':
                        $mes = 'FEV';
                    break;
                    case '3':
                        $mes = 'MAR';
                    break;
                    case '4':
                        $mes = 'ABRIL';
                    break;
                    case '5':
                        $mes = 'MAIO';
                    break;
                    case '6':
                        $mes = 'JUN';
                    break;
                    case '7':
                        $mes = 'JUL';
                    break;
                    case '8':
                        $mes = 'AGO';
                    break;
                    case '9':
                        $mes = 'SET';
                    break;
                    case '10':
                        $mes = 'OUT';
                    break;
                    case '11':
                        $mes = 'NOV';
                    break;
                    case '12':
                        $mes = 'DEZ';
                    break;
                }

                //Conferindo se o id do evento ja foi favoritado pelo usuario, caso tenha sido, não ira printar 
                $int_id= intval($selectEventos['id_evento']);
                if(in_array($int_id, $eventosFavoritos )){
                
                }else{

              

        ?>
        <div class="imgEvento" id="<?=$cont?>">
            <div class="boxData">
                <div class="div_dia"><?=$dia?></div>
                <div class="div_mes"><?=$mes?></div>
            </div>
            <div class="favoritar" id="<?='fav'.$cont?>" onclick="favoritar(<?=$cont?>,`fav<?=$cont?>`,<?=$selectEventos['id_evento']?>)">

            </div>
            <div class="local_hora">
                <div class="nome_local">
                    <div class="nome_evento">
                        <?=$selectEventos['nome']?>
                    </div>
                    <div class="local_evento">
                        <div class="div_local">
                            <div class="imgLocalizacao">
                            </div>
                            <div class="txtLocal"><?=$selectEventos['endereco']?></div>
                            <div class="div_hora"><?=$selectEventos['hora'].'h'?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
                }

                $cont++;
           }
        ?><script>
            resgataNumEventos(<?=$cont?>);
        </script>        
    </div>
</body>

</html>