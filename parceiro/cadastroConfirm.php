<?php

    session_start();
    require_once('../bd/conexao.php');

     echo $_SESSION['tipoCadastro'];

    $conexao = conexaoMySql();
    
    $telefoneProp = $_SESSION['arrayCadastro'][19] . $_SESSION['arrayCadastro'][20];

    if($_SESSION['tipoCadastro']=='evento'){
        $sql = "insert into tbl_eventos (nome,data_evnt,hora,descricao,
        cep,endereco,bairro,complemento,zona,cidade,uf,no_shopping,no_hotel,tel_evnt,nome_prop,celular_prop,telefone_prop,site,facebook,instagram,id_usuario) values
        ('".$_SESSION['arrayCadastro'][1]."','".$_SESSION['arrayCadastro'][2]."',".$_SESSION['arrayCadastro'][3].",'".$_SESSION['arrayCadastro'][4]."',
        '".$_SESSION['arrayCadastro'][5]."','".$_SESSION['arrayCadastro'][6]."','".$_SESSION['arrayCadastro'][7]."',
        '".$_SESSION['arrayCadastro'][8]."','".$_SESSION['arrayCadastro'][9]."','".$_SESSION['arrayCadastro'][10]."',
        '".$_SESSION['arrayCadastro'][11]."','".$_SESSION['arrayCadastro'][12]."','".$_SESSION['arrayCadastro'][13]."',
        '".$telefoneProp."','".$_SESSION['arrayCadastro'][21]."','".$_SESSION['arrayCadastro'][22]."',
        '".$_SESSION['arrayCadastro'][23]."','".$_SESSION['arrayCadastro'][29]."','".$_SESSION['arrayCadastro'][27]."',
        '".$_SESSION['arrayCadastro'][28]."','".$_SESSION['id_usuario']."')";
    }else{
        $sql = "insert into tbl_restaurantes (nome,email_restaurante,cnpj,telefone_restaurante,descricao,tipo_culinaria,
        cep,endereco,bairro,complemento,zona,cidade,uf,no_shopping,no_hotel,tel_res,nome_prop,celular_prop,telefone_prop,site,facebook,instagram,id_parceiro,
        dia_sem_inicial,dia_sem_final,hora_abre_sem,hora_fecha_sem,abre_sab,hora_abre_sab,hora_fecha_sab,abre_dom,hora_abre_dom,hora_fecha_dom) values
        ('".$_SESSION['arrayCadastro'][0]."',
        '".$_SESSION['arrayCadastro'][2]."',
        ".$_SESSION['arrayCadastro'][1].",
        '".$_SESSION['arrayCadastro'][3]."',
        '".$_SESSION['arrayCadastro'][5]."',
        '".$_SESSION['arrayCadastro'][4]."',
        '".$_SESSION['arrayCadastro'][6]."',
        '".$_SESSION['arrayCadastro'][7]."',
        '".$_SESSION['arrayCadastro'][8]."',
        '".$_SESSION['arrayCadastro'][9]."',
        '".$_SESSION['arrayCadastro'][10]."',
        '".$_SESSION['arrayCadastro'][11]."',
        '".$_SESSION['arrayCadastro'][12]."',
        '".$_SESSION['arrayCadastro'][13]."',
        '".$_SESSION['arrayCadastro'][14]."',
        '".$telefoneProp."',
        '".$_SESSION['arrayCadastro'][21]."',
        '".$_SESSION['arrayCadastro'][22]."',
        '".$_SESSION['arrayCadastro'][23]."',
        '".$_SESSION['arrayCadastro'][27]."',
        '".$_SESSION['arrayCadastro'][28]."',
        '".$_SESSION['arrayCadastro'][29]."',
        '".$_SESSION['id_usuario']."',
        ".$_SESSION['dia_abre_sem'].",
        ".$_SESSION['dia_fecha_sem'].",
        ".$_SESSION['hora_abre_sem'].",
        ".$_SESSION['hora_fecha_sem'].",
        ".$_SESSION['rodSab'].",
        ".$_SESSION['hora_abre_sabe'].",
        ".$_SESSION['hora_fecha_sab'] .",
        ".$_SESSION['rdoAbertoDom'].",   
        ".$_SESSION['hora_abre_dom'].",
        ".$_SESSION['hora_fecha_dom'].")";

        
        
        
         
        
        
        
        
        
        

        // echo $sql;

    }
        $criaParceiroSql = "update tbl_usuario set parceria = 1 where id_usuario =".$_SESSION['id_usuario']."";


        $rodaScriptParceiro = mysqli_query($conexao,$criaParceiroSql);

        $rodaScript = mysqli_query($conexao,$sql);
        
        $_SESSION['tipoCadastro'] = '';
        // echo $_SESSION['tipoCadastro'];
        // // var_dump($_SESSION['arrayCadastro']);
        echo($sql);
        // echo($criaParceiroSql);
        // session_unset($_SESSION['tipoCadastro']);

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
    <link rel="stylesheet" type="text/css" href="css/cadastroConfirm.css">



</head>

<body>
    <div id="boxVermelho">
        <div id="menu_logo">

            <div id="boxMenu">

                <img src="../images/imgsTelaPrincipal/menu.svg">
                <div id="div_menu">
                    <div class="menu_itens">
                        RESTAURANTES/EVENTOS
                    </div>
                    <div class="menu_itens">
                        RESERVAS
                    </div>
                </div>

            </div>
            <div id="boxLogo">
                <div id="centro_logo">
                    <img id="LogoPrincipal" src="../images/imgsTelaPrincipal/logo.png">
                </div>
            </div>
        </div>

    </div>
    <div id="areaCadastro">
        <div id="boxSteps">
            <div class="boxIcon friends"></div>
            <div class="boxIcon location" ></div>
            <div class="boxIcon user" ></div>
            <div class="boxIcon check" ></div>
        </div>

        <div id="txtTitulo">
            Obrigado!
        </div>
        <div id="txtConfirm">
            Seu cadastro está em analise e será liberado ou não em até 48h
        </div>
        <form method="POST" action="cadastroConfirm.php">
            <div id="btnInicio" onclick="window.location = 'parceiroRestaurante.php'">
                <div id="iconHome"></div>
                <div id="txtInicio">Ir para o início do app</div>
            </div>
        </form>
    </div>
</body>

</html>