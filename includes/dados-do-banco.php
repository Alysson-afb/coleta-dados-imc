<?php

    $localServidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBaseDados = "pw2-26-t1-imc";

    $con = new PDO("mysql:host=$localServidor;dbname=$nomeBaseDados", $usuario, $senha);

    ?>