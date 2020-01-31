<?php

function  conexaoMySql(){
    $host  = (String) "localhost";
    $password = (String) "";
    $user = (String) "root";
    $database = (String) "dbmenu";

    $conexao =mysqli_connect($host,$user,$password,$database);

    
    return $conexao;
}


?>