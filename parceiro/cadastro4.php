<?php

    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    echo $_SESSION['tipoCadastro'];
   
    function verificaTipo(){
        if($_SESSION['tipoCadastro']=='evento'){
            $link = 'cadastroEvento.php';
            return $link; 
        }else{
            $link= 'cadastroRestaurante.php';
            return $link;
        }
    }

//    $sql = "insert into tbl_restaurante (nome,email_restaurante,cnpj,telefone_restaurante,descricao,tipo_culinaria,
//     cep,endereco,bairro,complemento,zona,cidade,uf,no_shopping,no_hotel,nome_prop,ddd,celular_prop,telefone_prop,site,facebook,instagram,foto_empresa,foto_menu,status,id_parceiro,nota,cont) values
//      ('".$_SESSION['arrayCadastro'][0]."','".$_SESSION['arrayCadastro'][2]."','".$_SESSION['arrayCadastro'][1]."','".$_SESSION['arrayCadastro'][3]."',
//      '".$_SESSION['arrayCadastro'][5]."','".$_SESSION['arrayCadastro'][4]."','".$_SESSION['arrayCadastro'][6]."','".$_SESSION['arrayCadastro'][7]."',
//      '".$_SESSION['arrayCadastro'][8]."','".$_SESSION['arrayCadastro'][9]."','".$_SESSION['arrayCadastro'][10]."',
//      '".$_SESSION['arrayCadastro'][11]."','".$_SESSION['arrayCadastro'][12]."','".$_SESSION['arrayCadastro'][13]."',
//      '".$_SESSION['arrayCadastro'][14]."','".$_SESSION['arrayCadastro'][21]."','".$_SESSION['arrayCadastro'][22]."',
//      '".$_SESSION['arrayCadastro'][23]."')";

     

    var_dump($_SESSION['arrayCadastro']);
    if(isset($_POST['btnConcluir'])){
        array_push($_SESSION['arrayCadastro'], $_POST['txtSite'], $_POST['txtFacebook'],
        $_POST['txtInstagram']
        );

        
        header('location: cadastroConfirm.php');
    }

   
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
    <link rel="stylesheet" type="text/css" href="css/cadastroEvento4.css">



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
            <div class="boxIcon friends" ></div>
            <div class="boxIcon location" ></div>
            <div class="boxIcon user" ></div>
            <div class="boxIcon check" ></div>
        </div>
        <div id="txt1">Dados opcionais</div>
        <form method="POST" action="cadastro4.php" id="frmCadastro4">
            <input type="text" name="txtSite" class="txtInput" placeholder="Site">
            <input type="text" name="txtFacebook" class="txtInput" placeholder="Facebook">
            <input type="text" name="txtInstagram" class="txtInput" placeholder="Instagram">

            <label for="fleFotoEmpresa">
                <div class="div_fotos">
                    <div class="iconCamera"></div>
                    <div class="txtFotos">FOTOS DA EMPRESA</div>
                </div>
            </label>

            <input type="file" id="fleFotoEmpresa">

            <label for="fleFotoMenu">
                <div class="div_fotos">
                    <div class="iconCamera"></div>
                    <div class="txtFotos">FOTOS DO MENU</div>
                </div>
            </label>

            <input type="file" id="fleFotoMenu">

            <div id="div_concluir">
                <div class="iconEmail"></div>
                <input type="submit" name="btnConcluir" value="Concluir Cadastro" id="btnConcluir">
                <!-- <div class="txtConcluir">CONCLUIR CADASTRO</div> -->
            </div>
        </form>
    </div>
    
</body>

</html>