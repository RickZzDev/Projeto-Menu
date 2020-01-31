<?php
    //ESTA FUNÇÃO SERVE PARA ENVIAR A TABELA DE FAVORITOS O ID DO RESTAURANTE FAVORITADO
    session_start();

    
    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

    $id = $_POST['id'];

    $sql = 'insert into tbl_restaurantes_favoritos (id_restaurante, id_usuario) values ('.$id.', '.$_SESSION['id_usuario'].' )';
   
    $rodaScript = mysqli_query($conexao,$sql);




?>