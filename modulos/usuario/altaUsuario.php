<?php

    include "../../db/conexion.php";
    
    if (!isset($_POST['btnSubmit'])) {
        header('Location: ../../register.html');
 }

    $id = '';
    $usuario = trim($_POST['nombre']); //Nombre de Usuario    
    $email = $_POST['email']; //Email    
    $password = crypt($_POST['password'],$key); //Password   
    $Confirmar_password = crypt($_POST['Confirmar_password'],$key); //Confirmación de Password  

//error contraseña
    if ($password != $Confirmar_password) {        
        $titulo = "ERROR!";        
        $mensaje = "La Contraseña no coincide. Intenta nuevamente.";
        $enlace = '<a href="register.html" class="btn btn-success btn-block">Registrate</a>';          
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error   
        include "../../confirmar.php";
        exit;              
    } 
    
    $usuario = $conn->query("Select * From usuario Where nombre_usuario = '{$usuario}'")->fetch(PDO::FETCH_ASSOC);
//error usuario
    if (is_array($usuario)) {
        $titulo = "ERROR!";        
        $mensaje = "Algo no ha salido bien. El usuario ya existe.";
        $enlace = '<a href="register.html" class="btn btn-success btn-block"></a>';                
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error  
        include "confirmar.php";
        exit;        
    }

    $stmt = $conn->prepare("Insert Into usuario (`id_usuario`, `email`, `password`, `confirmar_password`, `nombre_usuario`)
        Values ('".$id."', '".$usuario."', '".$email."','".$password."','".$Confirmar_password."' )");

  
    $stmt->execute();
    $count = $stmt->rowCount();        
//informacion correcta

    if ($count == 1) {
        $titulo = "Bienvenido " . $usuario;        
        $mensaje = "Tu usuario se ha creado correctamente.";        
        $enlace = '<a href="../../micuenta.php" class="btn btn-success btn-block">OK</a>';        
        $icon = '<i class="material-icons">&#xE876;</i>'; //Success                
        $fondo = "#FFA726;"; //Success  
        session_start();
        $usuario = trim($_POST['nombre']);
        $_SESSION['usuario']=$usuario;
    } else {
        $titulo = "Ups!";        
        $mensaje = "Algo no ha salido bien. Intenta nuevamente.";
        $enlace = '<a href="login.html" class="btn btn-success btn-block">Iniciar Sesión</a>';                
        $icon = '<i class="material-icons">&#xE5CD;</i>'; //Error
        $fondo = "#e85e6c;"; //Error  
    }

    include "../../confirmar.php";
   

    ?>