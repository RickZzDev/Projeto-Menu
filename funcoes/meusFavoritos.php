<?php
    //ESTA FUNÇÃO VERIFICA QUAL O ELEMENTO QUE FOI CLICADO
    //E DEVOLVE O CODIGO HTML CORRESPONDENTE
    session_start();

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();



    $nome = $_POST['nome'];

    if($nome == 'restaurante'){
        //Criando sql para trazer os restaurantes favoritados
        $sql = "select tbl_restaurantes_favoritos.*,tbl_restaurantes.*
        from tbl_restaurantes_favoritos join tbl_restaurantes
        on tbl_restaurantes_favoritos.id_restaurante = tbl_restaurantes.id_restaurante
        where tbl_restaurantes_favoritos.id_usuario =".$_SESSION['id_usuario'];
    
        $rodaScript = mysqli_query($conexao,$sql);

        $_SESSION['pagina'] = 'restaurante';

        while($arrayRes = mysqli_fetch_array($rodaScript)){
            echo ('
            <div class="boxFavoritos">
                <div class="imgFavorito"></div>
                <div class="infos">
                    <div class="nomeRestaurante">'.$arrayRes['nome'] .'</div>
                    <div class  ="endereco">
                        <div class="iconEndereco">
                          
                        </div>
                        <div class="txtEndereco">
                            '.$arrayRes['endereco'] .'
                        </div>
                    </div>
                </div>
                <div class="imgSeta"></div>
            </div>');

           
        }

    }else{

        //Criando sql para trazer os restaurantes favoritados
        $sql = "select tbl_restaurantes_favoritos.*,tbl_restaurantes.*
        from tbl_restaurantes_favoritos join tbl_restaurantes
        on tbl_restaurantes_favoritos.id_restaurante = tbl_restaurantes.id_restaurante
        where tbl_restaurantes_favoritos.id_usuario =".$_SESSION['id_usuario'];
    
        $rodaScript = mysqli_query($conexao,$sql);

        $_SESSION['pagina'] = '';

        while($arrayRes = mysqli_fetch_array($rodaScript)){
            echo ('
            <div class="boxFavoritos">
                <div class="imgFavorito"></div>
                <div class="infos">
                    <div class="nomeRestaurante">'.$arrayRes['nome'] .'</div>
                    <div class  ="endereco">
                        <div class="iconEndereco">
                          
                        </div>
                        <div class="txtEndereco">
                            '.$arrayRes['endereco'] .'
                        </div>
                    </div>
                </div>
                <div class="imgSeta"></div>
            </div>');
        }
   
    }

    mysqli_close($conexao);
?>