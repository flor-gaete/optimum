<?php
    session_start();

    include "../db/conexion.php";
  
    if (!isset($_POST['btnSubmit']))
        header('Location: register.html'); 

    $id = "";
    $nombre = trim($_POST['nombre']); //Nombre de Usuario    
    $email = $_POST['email']; //Email    
    $password = crypt($_POST['password'],$key); //Password   
    $passwordConfirm = crypt($_POST['passwordConfirm'],$key); //Confirmación de Password  
    $fecha_registro = date('Y-m-d H:i:s'); //Fecha de Alta    
    $activo = 1;

    if ($password != $passwordConfirm) {        
        $titulo = "Ups!";        
        $mensaje = "La Contraseña no coincide. Intenta nuevamente.";
        $enlace = '<a href="register.html" class="btn btn-success btn-block">Iniciar Sesión</a>';          
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error   
        include "confirmar.php";
        exit;              
    } 
    
    $usuario = $conn->query("Select * From usuarios Where nombre = '{$nombre}'")->fetch(PDO::FETCH_ASSOC);

    if (is_array($usuario)) {
        $titulo = "Ups!";        
        $mensaje = "Algo no ha salido bien. El usuario ya existe.";
        $enlace = '<a href="register.html" class="btn btn-success btn-block">Iniciar Sesión</a>';                
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error  
        include "confirmar.php";
        exit;        
    }

    $stmt = $conn->prepare("Insert Into usuarios 
        Values (:id, :nombre, :email, :password, :fecha_registro, :activo)");

    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':nombre',$nombre);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':fecha_registro',$fecha_registro);
    $stmt->bindParam(':activo',$activo);
    $stmt->execute();
    $count = $stmt->rowCount();        

    if ($count == 1) {
        $titulo = "Bienvenido " . $nombre;        
        $mensaje = "Tu usuario se ha creado correctamente!.";        
        $enlace = '<a href="register.html" class="btn btn-success btn-block">OK</a>';        
        $icon = '<i class="material-icons">&#xE876;</i>'; //Success                
        $fondo = "#82ce34;"; //Success  
    } else {
        $titulo = "Ups!";        
        $mensaje = "Algo no ha salido bien. Intenta nuevamente.";
        $enlace = '<a href="login.html" class="btn btn-success btn-block">Iniciar Sesión</a>';                
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error  
    }

    include "confirmar.php";
    

?>

