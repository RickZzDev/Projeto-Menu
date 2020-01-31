<?php

    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    // var_dump($_SESSION['arrayCadastro']);

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

    /*********************SELECT DADOS EXISTENTES***********************************/
    
    $sql = "select * from tbl_usuario where id_usuario =".$_SESSION['id_usuario'];
    
    $rodaScript = mysqli_query($conexao,$sql);

    $arraySelect = mysqli_fetch_array($rodaScript);

    // var_dump($arraySelect);     
    /*******************************************************************************/
    echo($ddd = substr($arraySelect['celular'], 1, -12));
    $numCelular = substr($arraySelect['celular'],4);
    /************************* */


    var_dump($_SESSION['arrayCadastro']);

   

    if(isset($_POST['btnContinuar'])){

        $telefone_prop = $_POST['txtDDDCelularNovoProp'].$_POST['txtCelularNovoProp'];
        $celular_prop = $_POST['txtDDDTelefoneNovoProp'].$_POST['txtTelefoneNovoProp'];
       
        array_push($_SESSION['arrayCadastro'],
            $_SESSION['nome_prop'] = $_POST['nome_prop'],
            $_SESSION['email_prop'] = $_POST['email_prop'],
            $_SESSION['ddd_prop'] = $_POST['txtDDD_prop'],
            $_SESSION['txtCelular'] = $_POST['txtCelular_prop'],
            $_SESSION['txtDDDTelefone'] = $_POST['txtDDDTelefone_prop'],
            $_SESSION['txtTelefone'] = $_POST['txtTelefone_prop'],
            $_SESSION['nomeNovoProp'] = $_POST['nomeNovoProp'],
            $_SESSION['emailNovoProp'] = $_POST['emailNovoProp'],
            $_SESSION['DDDCelularNovoProp'] = $_POST['txtDDDCelularNovoProp'],
            $_SESSION['txtCelularNovoProp'] = $_POST['txtCelularNovoProp'],
            $_SESSION['txtDDDTelefoneNovoProp'] = $_POST['txtDDDTelefoneNovoProp'],
            $_SESSION['txtTelefoneNovoProp'] = $_POST['txtTelefoneNovoProp']

        );

        
        

        header('location: cadastro4.php');
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
    <link rel="stylesheet" type="text/css" href="css/cadastroEvento3.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.form.js"></script>
    <script>

        function desabilitaInput(){
            document.getElementById('txtNomeProp').style.pointerEvents = 'none';
            document.getElementById('txtEmailProp').style.pointerEvents = 'none';
            document.getElementById('txtDDDProp').style.pointerEvents = 'none';
            document.getElementById('txtCelularProp').style.pointerEvents = 'none';
            document.getElementById('txtDDDTelefoneProp').style.pointerEvents = 'none';
            document.getElementById('txtTelefoneProp').style.pointerEvents = 'none';
        }

        function valorInput(){

            var valorInput = document.getElementById('rdo_prop');
        
            if(valorInput.value == 'sim'){
               desabilitaInput();
            }
        }

        function valorInput2(){
            var valorInput = document.getElementById('rdo_prop2');
            if(valorInput.value == 'nao'){
                document.getElementById('txtNomeProp').style.pointerEvents = 'auto';
            document.getElementById('txtEmailProp').style.pointerEvents = 'auto';
            document.getElementById('txtDDDProp').style.pointerEvents = 'auto';
            document.getElementById('txtCelularProp').style.pointerEvents = 'auto';
            document.getElementById('txtDDDTelefoneProp').style.pointerEvents = 'auto';
            document.getElementById('txtTelefoneProp').style.pointerEvents = 'auto';
            }
        }

   
    </script>
</head>

<body onload=desabilitaInput()>
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
        <div id="txt1">Dados para contato</div>
        <form method="POST" action="cadastro3.php" id="frmCadastro3">
            <input type="text" name="nome_prop" class="txtInput"  readonly value="<?=@$arraySelect['nome']?>" placeholder="Nome">
            <input type="text" name="email_prop" class="txtInput"  readonly value="<?=@$arraySelect['email']?>" placeholder="Email">
            <div id="ddd_celular">
                <input type="text" name="txtDDD_prop" value="<?=$ddd?>" readonly class="txtDDD" placeholder="DDD">
                <input type="text" name="txtCelular_prop" class="txtCelular"  readonly  value="<?=@$numCelular?>" placeholder="Celular">
            </div>
            <div id="cidade_uf">
                <input type="text" name="txtDDDTelefone_prop"  class="txtDDD" placeholder="DDD">
                <input type="text" name="txtTelefone_prop" id="txtTelefone_prop" onkeypress="return mascaraNumero2(this,event);"  class="txtCelular" placeholder="Telefone">
            </div>

            <div id="boxProprietario">
                <div id="tituloProprietario">
                    Sou proprietario
                </div>
                <div id="divRdos">
                    <div class="boxRdos">
                        <div class="divSimNao">
                            Sim
                        </div>
                        <div class="divRdo">
                            <input name="rdo_prop" onchange="valorInput()" value="sim" checked id="rdo_prop"  type="radio">
                        </div>
                    </div>
                    <div class="boxRdos">
                        <div class="divSimNao">
                            Não
                        </div>
                        <div class="divRdo">
                            <input name="rdo_prop"  onchange="valorInput2()"  value="nao" id="rdo_prop2" type="radio">
                        </div>
                    </div>
                </div>
            </div>

            <input type="text" id="txtNomeProp"  name="nomeNovoProp" class="txtInput" placeholder="Nome">
            <input type="text" id="txtEmailProp"  name="emailNovoProp" class="txtInput" placeholder="Email">
            <div id="ddd_celular">
                <input type="text" id="txtDDDNovoProp"  name="txtDDDCelularNovoProp" class="txtDDD" placeholder="DDD">
                <input type="text" id="txtCelularNovoProp"  name="txtCelularNovoProp" class="txtCelular" placeholder="Celular">
            </div>
            <div id="cidade_uf">
                <input type="text" id="txtDDDTelefoneNovoProp"  type="number" name="txtDDDTelefoneNovoProp" class="txtDDD" placeholder="DDD">
                <input type="text" id="txtTelefoneNovoProp"  name="txtTelefoneNovoProp" class="txtCelular" placeholder="Telefone">
            </div>
            <label for="btnContinuarInput">
                <div id="btnContinuar">
                    CONTINUAR
                    <div id="iconSeta">

                    </div>
                </div>
            </label>

            <input type="submit" id="btnContinuarInput" name="btnContinuar">
        </form>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>