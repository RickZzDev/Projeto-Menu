<?php

    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    if(isset($_POST['numPessoas'])){
        array_push($_SESSION['reservaArray'], $_POST['numPessoas']);
        echo json_encode($_SESSION['reservaArray']);
    }
    elseif(isset($_POST['obs']))
    {
        array_push($_SESSION['reservaArray'], $_POST['obs']);
    }
    elseif(isset($_POST['horaEscolhido']))
    {
        $_SESSION['reservaArray'] = array(
            'horaEscolhido' => $_POST['horaEscolhido'],
            'diaEscolhido' => $_POST['diaEscolhido']
          
        );

        echo json_encode($_SESSION['reservaArray']);
    }
    else
    {

   
    //Recuperando viriavel enviada pelo ajax e criando o select
    $numDia = $_POST['numDia'];

    $sql = "select * from tbl_restaurantes where id_restaurante = ".$_SESSION['id_restaurante']." ";

    $rodaScript = mysqli_query($conexao,$sql);

    $arrayRestaurante = mysqli_fetch_array($rodaScript);

    if($numDia >= 1 && $numDia<=5){
       $horaAbre =  $arrayRestaurante['hora_abre_sem'];
       $horaFecha = $arrayRestaurante['hora_fecha_sem'];
    }elseif($numDia==6){
        $horaAbre =  $arrayRestaurante['hora_abre_sab'];
        $horaFecha = $arrayRestaurante['hora_fecha_sab'];
    }else{
        $horaAbre =  $arrayRestaurante['hora_abre_dom'];
        $horaFecha = $arrayRestaurante['hora_fecha_dom'];
    }

    

    // $rodaScript = mysqli_query($conexao,$sql);

    // $arr = array(
    //     'a' => 1,
    //     'b' => 0
    // );

    $arr = array(
        0 => $horaAbre,
        1 => $horaFecha
    );

    echo json_encode($arr);
}


?>