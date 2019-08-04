<?php
    session_start();

    include "../db/conexion.php";

    //Recupero los datos como Arreglo Asociativo
    $postData = json_decode($_POST['data'],true);

    $usuarioNombre = $postData['nombre']; //Nombre de Usuario    
    
    $usuario = $conn->query("Select * From usuarios Where nombre = $usuarioNombre")->fetch(PDO::FETCH_ASSOC);

    echo json_encode($usuario,JSON_FORCE_OBJECT);
