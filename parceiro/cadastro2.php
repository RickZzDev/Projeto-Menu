<?php

    session_start();

 
    // echo $_SESSION['tipoCadastro'];

    // var_dump($_SESSION['arrayCadastro']);
    $teste = 'cadastro3.php';
    function verificaTipo(){
        if($_SESSION['tipoCadastro']=='evento'){
            $link = 'cadastroEvento.php';
            return $link; 
        }else{
            $link= 'cadastroRestaurante.php';
            return $link;
        }
    }

    

    if(isset($_POST['btnContinuar'])){

        array_push($_SESSION['arrayCadastro'],
        $_SESSION['cep'] = $_POST['txtCep'],
        $_SESSION['endereco'] = $_POST['endereco_numero'],
        $_SESSION['bairro'] = $_POST['txtBairro'],
        $_SESSION['complemento'] = $_POST['txtComplemento'],
        $_SESSION['zona'] = $_POST['txtZona'],
        $_SESSION['cidade'] = $_POST['txtCidade'],
        $_SESSION['uf'] = $_POST['txtUf'],
        $_SESSION['rdoShopping'] = $_POST['rdoShopping'],
        $_SESSION['rdoHotel'] = $_POST['rdoHotel']

        );

        var_dump($_SESSION['arrayCadastro']);




        header("location: cadastro3.php");
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
    <link rel="stylesheet" type="text/css" href="css/cadastroEvento2.css">


    <style>
        #link{
            display: inline-block;
        }
    </style>
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
          
            <div class="boxIcon friends" onclick="window.location = '<?=verificaTipo()?>'"></div>
            <div class="boxIcon location" onclick="window.location = 'cadastro2.php'"></div>
            <div class="boxIcon user" onclick="window.location = 'cadastro3.php'"></div>
            <div class="boxIcon check" onclick="window.location = 'cadastro4.php'"></div>
        </div>
        <div id="txt1">LOCALIZAÇÃO</div>
    <form method="POST" action="cadastro2.php" id="frmCadastro2">
        <input type="text" name="txtCep" class="txtInput" placeholder="CEP">
        <input type="text" name="endereco_numero" class="txtInput" placeholder="Endereço, numero">
        <input type="text" name="txtBairro" class="txtInput" placeholder="Bairro">
        <div id="complemento_zona">
            <input type="text" name="txtComplemento" id="txtComplemento" placeholder="Complemento">
            <input type="text" name="txtZona" id="txtZona" placeholder="Zona">
        </div>
        <div id="cidade_uf">
            <input type="text" name="txtCidade" id="txtCidade" placeholder="Cidade">
            <input type="text" name="txtUf" id="txtUf" placeholder="UF">
        </div>
        <div id="box_shopping_hotel">
            <div class="areaShopping">
                <div class="txtShopping">
                    Localizada em Shopping?
                </div>
                <div class="rdoSimNao">
                    <div class="boxRdo">
                        <div class="boxSimNao" >
                            Sim
                        </div>
                    </div>
                    <input type="radio" name="rdoShopping" value="1">
                    <div class="boxRdo">
                        Não

                    </div>
                    <input type="radio" name="rdoShopping" required value="0">
                </div>

            </div>
            <div class="areaShopping">
                <div class="txtShopping">
                    Localizada em Hotel?
                </div>
                <div class="rdoSimNao">
                    <div class="boxRdo">
                        <div class="boxSimNao">
                            Sim
                        </div>
                    </div>
                    <input type="radio" name="rdoHotel" value="1">
                    <div class="boxRdo" >
                        Não

                    </div>
                    <input type="radio" name="rdoHotel" required  value="0">
                </div>
            </div>
        </div>

        <label for="btnContinuarInput">
            <div id="btnContinuar">
                CONTINUAR
                <div id="iconSeta">

                </div>
            </div>
        </label>
        <input type="submit" name="btnContinuar" id="btnContinuarInput">
    </form>
    </div>
</body>

</html>