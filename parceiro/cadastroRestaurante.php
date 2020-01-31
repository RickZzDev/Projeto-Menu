
<?php

    session_start();

    require_once('../bd/conexao.php');

    $_SESSION['tipoCadastro'] = 'restaurante';

    echo $_SESSION['tipoCadastro'];

    $conexao = conexaoMySql();



    if(isset($_POST['btnContinuar'])){

        $_SESSION['dia_abre_sem'] = $_POST['dia_inicial'];
        $_SESSION['dia_fecha_sem'] = $_POST['dia_final'];
        $_SESSION['hora_abre_sem'] = $_POST['hora_abre_sem'];
        $_SESSION['hora_fecha_sem'] = $_POST['hora_fecha_sem'];
        $_SESSION['rodSab'] = $_POST['rdoAbertoSab'];
        $_SESSION['hora_abre_sabe'] = $_POST['hora_abre_sab'];
        $_SESSION['hora_fecha_sab'] = $_POST['hora_fecha_sab'];
        $_SESSION['rdoAbertoDom'] = $_POST['rdoAbertoDom'];
        $_SESSION['hora_abre_dom'] =$_POST['hora_abre_dom'];
        $_SESSION['hora_fecha_dom'] = $_POST['hora_fecha_dom'];



        $_SESSION['arrayCadastro'] = array(
            $_SESSION['nome'] = $_POST['txtNome'],
            $_SESSION['cnpj'] = $_POST['txtCnpj'],
            $_SESSION['email'] = $_POST['txtEmail'],
            $_SESSION['telefone'] = $_POST['txtTelefone'],
            $_SESSION['culinaria'] = $_POST['txtTipoCulinaria'],
            $_SESSION['descricao'] = $_POST['txtDescricao']
        );

    
        var_dump($_SESSION['arrayCadastro']);

        header("location: cadastro2.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/cadastroEvento1.css">

    <script>
        function desabilitaInput(id,id2){
            document.querySelector(`.${id}`).style.pointerEvents = 'none';
            document.querySelector(`.${id2}`).style.pointerEvents = 'none';
        }

        function valorInput(id,id2){

            var valorInput = document.getElementById('rdoAbertoNao');
            alert(id)
            desabilitaInput(id,id2);
        }

        function valorInput2(id,id2){
            var valorInput = document.getElementById('rdoAbertoSim');
            
            if(valorInput.value == 1){
                document.querySelector(`.${id}`).style.pointerEvents = 'auto';
                document.querySelector(`.${id2}`).style.pointerEvents = 'auto';
            }
        }
    </script>

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
            <div class="boxIcon friends"  ></div>
            <div class="boxIcon location" onclick="window.location = 'cadastro2.php'" ></div>
            <div class="boxIcon user" onclick="window.location = 'cadastro3.php'"></div>
            <div class="boxIcon check" onclick="window.location = 'cadastro4.php'"></div>
        </div>
        <div id="txt1">Selecione o tipo de empresa</div>
        <div id="boxRadios">
            <div id="restaurante_radio">
                <input type="radio" name="rdo" checked onclick="window.location = 'cadastroRestaurante.php'">
                <div id="txtRestaurante">Restaurantes</div>
            </div>
            <div id="evento_radio">
                <input type="radio" name="rdo"  onclick="window.location = 'cadastroEvento.php'" >
                <div id="txtRestaurante">Eventos e shows</div>
            </div>
        </div>
        <form id="frmCadastro" method="POST" action="cadastroRestaurante.php">
            <input type="text" class="txtInput" name="txtNome" placeholder="Nome">
            <input type="text" class="txtInput" name="txtCnpj" placeholder="CNPJ">
            <input type="text" class="txtInput" name="txtEmail" placeholder="E-mail">
            <input type="text" class="txtInput" name="txtTelefone" id="txtTelefone" onkeypress="return mascaraNumero(this,event);"placeholder="Telefone">
            <input type="text" class="txtInput" name="txtTipoCulinaria" placeholder="Tipo de culinaria:">
            <label for="fleFotoLogo">
                <div id="div_logo_marca">
                    <div id="iconCamera">
                    </div>
                    <div id="txtLogo">LOGO MARCA</div>
                    <input type="file" id="fleFotoLogo">
                </div>
            </label>
            <div id="horarioFuncionamento" >
                <h5>Dias de funcionamento na semana</h5>
                <div class="input-group mb-3" id="sltDe">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">De</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name='dia_inicial'>
                        <option value="" selected>Escolha...</option>
                        <option value="1">Segunda</option>
                        <option value="2">Terça</option>
                        <option value="3">Quarta</option>
                        <option value="4">Quinta</option>
                        <option value="5">Sexta</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">Á</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="dia_final">
                        <option value="" selected>Escolha...</option>
                        <option value="1">Segunda</option>
                        <option value="2">Terça</option>
                        <option value="3">Quarta</option>
                        <option value="4">Quinta</option>
                        <option value="5">Sexta</option>
                    </select>
                </div>
                <h5>Horario de funcionamento<h5>
                <div class="input-group mb-3" id="sltDe">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">Das</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="hora_abre_sem">
                        <option selected>Escolha...</option>
                        <?php
                            $cont = 0;
                            for($cont;$cont<=24;$cont++){?>
                                    <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                        <?php   }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">Ás</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="hora_fecha_sem">
                        <option value="" selected>Escolha...</option>
                        <?php
                            $cont = 0;
                            for($cont;$cont<=24;$cont++){?>
                                    <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                        <?php   }
                        ?>
                    </select>
                </div>   
            </div>
            <div class="chkFimDeSemana">
                <h5>Aberto aos sábados?</h5>
                <div id="boxRadios">
                    <div id="restaurante_radio">
                        <input type="radio" name="rdoAbertoSab" id="rdoAbertoSim" value=1 onchange="valorInput2('sltHoraSabAbre','sltHoraSabFecha')" checked >
                        <div id="txtRestaurante">Sim</div>
                    </div>
                    <div id="evento_radio">
                        <input type="radio" name="rdoAbertoSab" id="rdoAbertoNao" onchange="valorInput('sltHoraSabAbre','sltHoraSabFecha')" value=0   >
                        <div id="txtRestaurante" >Não</div>
                    </div>
                </div>
            </div>
            <div id="horarioFuncionamentoFds" >
                <h5>Horario de funcionamento aos sábados<h5>
                <div class="input-group mb-3" id="sltDe">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">Das</label>
                    </div>
                    <select class="custom-select sltHoraSabAbre" id="inputGroupSelect01" name="hora_abre_sab">
                        <option value="" selected >Escolha...</option>
                        <?php
                            $cont = 0;
                            for($cont;$cont<=24;$cont++){?>
                                    <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                        <?php   }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="bsDe">
                        <label class="input-group-text" for="inputGroupSelect01">Ás</label>
                    </div>
                    <select class="custom-select sltHoraSabFecha" id="inputGroupSelect01" name="hora_fecha_sab">
                        <option value="" selected>Escolha...</option>
                        <?php
                            $cont = 0;
                            for($cont;$cont<=24;$cont++){?>
                                    <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                        <?php   }
                        ?>
                    </select>
                </div>
                
                <div id="chkFimDeSemana">
                    <h5>E aos domingos?....</h5>
                    <div id="boxRadios">
                        <div id="restaurante_radio">
                            <input type="radio" name="rdoAbertoDom" onchange="valorInput2('sltHoraDomAbre','sltHoraDomFecha')" value=1 checked>
                            <div id="txtRestaurante">Sim</div>
                        </div>
                        <div id="evento_radio">
                            <input type="radio" name="rdoAbertoDom" onchange="valorInput('sltHoraDomAbre','sltHoraDomFecha')" value=0  >
                            <div id="txtRestaurante">Não</div>
                        </div>
                    </div>
                    <div class="input-group mb-3" id="sltDe">
                        <div class="input-group-prepend" id="bsDe">
                            <label class="input-group-text" for="inputGroupSelect01">Das</label>
                        </div>
                        <select class="custom-select sltHoraDomAbre" id="inputGroupSelect01" name="hora_abre_dom">
                            <option  value="" selected>Escolha...</option>
                            <?php
                                $cont = 0;
                                for($cont;$cont<=24;$cont++){?>
                                        <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                            <?php   }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend" id="bsDe">
                            <label class="input-group-text" for="inputGroupSelect01">Ás</label>
                        </div>
                        <select class="custom-select sltHoraDomFecha " id="inputGroupSelect01" name="hora_fecha_dom">
                            <option value="" selected>Escolha...</option>
                            <?php
                                $cont = 0;
                                for($cont;$cont<=24;$cont++){?>
                                        <option class="custom-select" value="<?=$cont?>"><?=$cont?> </option>
                            <?php   }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="text" id="txtInputObs" name="txtDescricao" placeholder="Descrição">
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
    <script src="../js/script.js"></script>
</body>

</html>