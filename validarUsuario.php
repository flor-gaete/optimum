<?php
    include "../db/conexion.php";

    if (!isset($_POST['btnSubmit'])){
        header('Location:../login.html');       
    }
        
    $nombre = $_POST['nombre']; //Nombre de Usuario
    $password = crypt($_POST['password'],$key); //Password
    
    $usuario = $conn->query("Select * From usuarios Where nombre = '{$nombre}' and password = '{$password}'")->fetch(PDO::FETCH_ASSOC);
    
    if (is_array($usuario) And $usuario['activo'] == 1) {
        $titulo = "Bienvenido " . $usuario['nombre'];        
        $mensaje = "Has iniciado sesión correctamente!.";        
        $enlace = '<a href="micuenta.html" class="btn btn-success btn-block">OK</a>';        
        $icon = '<i class="material-icons">&#xE876;</i>'; //Success                
        $fondo = "#82ce34;"; //Success  
        $_SESSION['usuario'] = $usuario['nombre'];      
    } else {        
        $titulo = "Ups!";        
        $mensaje = "Algo no ha salido bien. Intenta nuevamente.";
        $enlace = '<a href="login.html" class="btn btn-success btn-block">Iniciar Sesión</a>';             
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error          
    }

    include "confirmar.php";