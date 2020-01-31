<?php

        session_start();

        require_once('../bd/conexao.php');

        $conexao = conexaoMySql();
        /*Recuperando o id enviado pelo ajax*/
        $id = $_POST['idDb'];

        $sql = 'insert into tbl_favoritos (id_evento,id_usuario) values ('.$id.','.$_SESSION['id_usuario'].')';
        
        $rodaScript = mysqli_query($conexao,$sql);
      

       echo json_encode($sql);

    

?>